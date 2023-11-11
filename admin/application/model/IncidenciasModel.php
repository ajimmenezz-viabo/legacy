<?php

class IncidenciasModel
{
    public static function obtenerIncidencias($idComercio, $idUsuario, $estatus, $buscar)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerIncidencias(:idComercio, :idUsuario, :estatus, :buscar)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio, ':idUsuario' => $idUsuario, ':estatus' => $estatus, ':buscar' => $buscar));

        return $query->fetchAll();
    }
	
	public static function agregarIncidencia()
	{
		$idUsuario = Request::post('idUsuario');
		$idComercio = Request::post('idComercio');
		$tipo = Request::post('tipo');
		$idTipo = Request::post('idTipo');
		$solicita = Request::post('solicita');
		$idSolicita = Request::post('idSolicita');
		$idCategoria = Request::post('idCategoria');
		$incidencia = strip_tags(trim(Request::post('incidencia')));
		$descripcion = strip_tags(trim(Request::post('descripcion')));
	
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL incidencias_agregarIncidencia(:idUsuario, :idComercio, :tipo, :idTipo, :solicita, :idSolicita, :idCategoria, :incidencia, :descripcion)";
        $query = $database->prepare($sql);		
        $query->execute(array(':idUsuario' => $idUsuario,
							  ':idComercio' => $idComercio,
							  ':tipo' => $tipo,
							  ':idTipo' => $idTipo,
							  ':solicita' => $solicita,
							  ':idSolicita' => $idSolicita,
							  ':idCategoria' => $idCategoria,
							  ':incidencia' => $incidencia,
							  ':descripcion' => $descripcion
							 )
					   );
		$result = $query->fetch();
		$query->closeCursor();
		
		if ($result->success) {
			$idIncidencia = $result->idIncidencia;
			
			if ($idUsuario != "") {
				NotificacionesModel::enviarNotificacionIncidencia($idIncidencia, $idComercio);
			}	
		}
		
		return array("success" => true);
	}
	
	public static function actualizarIncidencia()
	{
		$idUsuario = Request::post('idUsuario');
		$idComercio = Request::post('idComercio');
		$tipo = Request::post('tipo');
		$idTipo = Request::post('idTipo');
		$solicita = Request::post('solicita');
		$idSolicita = Request::post('idSolicita');
		$idCategoria = Request::post('idCategoria');
		$incidencia = strip_tags(trim(Request::post('incidencia')));
		$descripcion = strip_tags(trim(Request::post('descripcion')));
		$idIncidencia = Request::post('idIncidencia');
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL incidencias_actualizarIncidencia(:idUsuario, :idComercio, :tipo, :idTipo, :solicita, :idSolicita, :idCategoria, :incidencia, :descripcion, :idIncidencia)";
        $query = $database->prepare($sql);		
        $query->execute(array(':idUsuario' => $idUsuario,
							  ':idComercio' => $idComercio,
							  ':tipo' => $tipo,
							  ':idTipo' => $idTipo,
							  ':solicita' => $solicita,
							  ':idSolicita' => $idSolicita,
							  ':idCategoria' => $idCategoria,
							  ':incidencia' => $incidencia,
							  ':descripcion' => $descripcion,
							  ':idIncidencia' => $idIncidencia
							 )
					   );
		$result = $query->fetch();
		
		return array("success" => true);
	}
	
	public static function terminarIncidencia()
	{
		$resolucion = Request::post('resolucion');
		$idComercio = Request::post('idComercio');
		$idIncidencia = Request::post('idIncidencia');
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL incidencias_terminarIncidencia(:resolucion, :idUsuario, :idComercio, :idIncidencia)";
        $query = $database->prepare($sql);		
        $query->execute(array(':resolucion' => $resolucion,
							  ':idUsuario' => Session::get('idUsuario'),
							  ':idComercio' => $idComercio,
							  ':idIncidencia' => $idIncidencia
							 )
					   );
		
		return array("success" => true);
	}
	
	public static function obtenerIncidencia($idIncidencia, $idComercio)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerIncidencia(:idIncidencia, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idIncidencia' => $idIncidencia, ':idComercio' => $idComercio));

        return $query->fetch();
    }
	
	public static function obtenerAnotacionesIncidencia($idIncidencia, $privada)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerAnotacionesIncidencia(:idIncidencia, :privada)";
        $query = $database->prepare($sql);
        $query->execute(array(':idIncidencia' => $idIncidencia, ':privada' => $privada));

        return $query->fetchAll();
    }
	
	public static function agregarAnotacionIncidencia()
	{
		$idIncidencia = Request::post('idIncidencia');
		$idComercio = Request::post('idComercio');
		$anotacion = strip_tags(trim(Request::post('anotacion')));
		$privada = Request::post('privada');
	
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL incidencias_agregarAnotacionIncidencia(:idIncidencia, :idUsuario, :anotacion, :privada)";
        $query = $database->prepare($sql);		
        $query->execute(array(':idIncidencia' => $idIncidencia,
							  ':idUsuario' => Session::get('idUsuario'),
							  ':anotacion' => $anotacion,
							  ':privada' => $privada
							 )
					   );
		$result = $query->fetch();
		$query->closeCursor();
		
		// Notificacion involucrados
		if ($result->success) {
			$idAnotacion = $result->idAnotacion;
			
			NotificacionesModel::enviarNotificacionAnotacionIncidencia($idAnotacion, $idIncidencia, $idComercio);
		}
		return array("success" => true);
	}
	
	public static function obtenerAdjuntosAnotacionIncidencia($idAnotacion)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerAdjuntosAnotacionIncidencia(:idAnotacion)";
        $query = $database->prepare($sql);
        $query->execute(array(':idAnotacion' => $idAnotacion));

        return $query->fetchAll();
    }
	
	public static function obtenerAdjuntoAnotacionIncidencia($idAdjunto)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerAdjuntoAnotacionIncidencia(:idAdjunto)";
        $query = $database->prepare($sql);
        $query->execute(array(':idAdjunto' => $idAdjunto));

        return $query->fetch();
    }
	
	public static function obtenerUsuariosIncidencia($idIncidencia)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL incidencias_obtenerUsuariosIncidencia(:idIncidencia)";
        $query = $database->prepare($sql);
        $query->execute(array(':idIncidencia' => $idIncidencia));

        return $query->fetchAll();
    }
	
	public static function agregarUsuarioIncidencia()
	{
		$idIncidencia = Request::post('idIncidencia');
		$idComercio = Request::post('idComercio');
		$idUsuario = Request::post('idUsuario');
	
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL incidencias_agregarUsuarioIncidencia(:idIncidencia, :idUsuario)";
        $query = $database->prepare($sql);		
        $query->execute(array(':idIncidencia' => $idIncidencia,
							  ':idUsuario' => $idUsuario,
							 )
					   );
		
		// NotificacionesModel::enviarNotificacionUsuarioIncidencia($idUsuario, $idIncidencia, $idComercio);
		
		return array("success" => true);
	}
	
}
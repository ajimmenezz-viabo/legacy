<?php

class PinsModel
{
    public static function agregarPin()
    {		
		$tipo = Request::post('tipo');
		$idTipo = Request::post('idTipo');
		$pin = Request::post('pin');
		$idUsuarios = Request::post('idUsuarios');
		
		if ($idUsuarios != "") {
			foreach ($idUsuarios as $idUsuario) {
				
				// AlertasModel::agregarAlerta($idUsuario, "reservacion", "Nueva mención en comentario en R" . str_pad($idReservacion, 5, "0", STR_PAD_LEFT), "https://www.itravel.mx/new/reservaciones/detalleReservacion/" . $idReservacion . "#comentarios");
			}
			
			$idUsuarios = json_encode($idUsuarios);
		}
		
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL pins_agregarPin(:idUsuario, :tipo, :idTipo, :pin, :idUsuarios)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => Session::get('idUsuario'),
							  ':tipo' => $tipo,
							  ':idTipo' => $idTipo,
							  ':pin' => $pin,
							  ':idUsuarios' => $idUsuarios
							 )
					   );
		
		/* AlertasModel::agregarAlerta($reservacion->idUsuario, "pagos", "Pago aplicado en R" . str_pad($reservacion->idReservacion, 5, "0", STR_PAD_LEFT), "https://www.itravel.mx/new/reservaciones/detalleReservacion/" . $reservacion->idReservacion . "#pagos"); */
		
        return $query->fetch();
    }
	
	public static function obtenerPins()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL pins_obtenerPins(:idUsuario)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => Session::get('idUsuario')));

        return $query->fetchAll();
    }
	
	public static function removerPin($idPin)
    {		
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL pins_removerPin(:idPin)";
        $query = $database->prepare($sql);
        $query->execute(array(':idPin' => $idPin)
					   );
        return $query->fetch();
    }
	
}
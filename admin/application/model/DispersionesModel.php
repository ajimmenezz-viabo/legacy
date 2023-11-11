<?php

class DispersionesModel
{
	public static function obtenerDispersiones($idComercio, $idTarjetaOrigen, $idTarjetaDestino, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL dispersiones_obtenerDispersiones(:idComercio, :idTarjetaOrigen, :idTarjetaDestino, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio, ':idTarjetaOrigen' => $idTarjetaOrigen, ':idTarjetaDestino' => $idTarjetaDestino, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}

	public static function agregarDispersion()
	{	
		$idTarjetaOrigen = Request::post('idTarjetaOrigen');
		$idTarjetaDestino = Request::post('idTarjetaDestino');
		$accion = Request::post('accion');
		$monto = Request::post('monto');
		$comentarios = 	Request::post('comentarios');
		$idComercio = 	Request::post('idComercio');
		
	/*	
		$idTarjetaOrigen = 1;
		$idTarjetaDestino = 2;
		$accion = "Fondear";
		$monto = 143.30;
		$comentarios = 	"Prueba Viabo Admin";
		$idComercio = 1683;
	*/
		
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "CALL dispersiones_agregarDispersion(:idComercio, :idUsuario, :idTarjetaOrigen, :idTarjetaDestino, :accion, :monto, :comentarios)";
		$query = $database->prepare($sql);
		$query->execute(array(':idComercio' => $idComercio,
							  ':idUsuario' => Session::get('idUsuario'),
							  ':idTarjetaOrigen' => $idTarjetaOrigen,
							  ':idTarjetaDestino' => $idTarjetaDestino,
							  ':accion' => $accion,
							  ':monto' => $monto,
							  ':comentarios' => $comentarios,
							 )
					   );
		$result = $query->fetch();
		$query->closeCursor();
		
		$tarjetaOrigen = TarjetasModel::obtenerTarjetaPorIdTarjeta($idTarjetaOrigen);
		$tarjetaDestino = TarjetasModel::obtenerTarjetaPorIdTarjeta($idTarjetaDestino); 
				
		if ($accion == "Reversar") {
			$response = ViaboModel::transferirEntreTarjetas($tarjetaDestino, $tarjetaOrigen, $monto);
		} else {
			$response = ViaboModel::transferirEntreTarjetas($tarjetaOrigen, $tarjetaDestino, $monto);
		}
		
		if ($result->success) {
			$idDispersion = $result->idDispersion;
			
			// NotificacionesModel::enviarNotificacionDispersion($idDispersion);
				
			return (object) array("success" => true, "idDispersion" => $idDispersion);
		} else {
			
			return (object) array("success" => false);
		}
	}
}
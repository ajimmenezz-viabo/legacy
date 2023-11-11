<?php

class CobrosModel
{
	public static function obtenerCobros($estatus, $tipo)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cobros_obtenerCobros(:estatus, :tipo)";
        $query = $database->prepare($sql);
        $query->execute(array(':estatus' => $estatus, ':tipo' => $tipo));

        return $query->fetchAll();
	}
	
	public static function agregarCobro()
	{
		$idComercio = Request::post('idComercio');
		$tipo = Request::post('tipo');
		$idTipo = Request::post('idTipo');
		$monto = Request::post('monto');
		$comision = Request::post('comision');
		$nombreCompleto = Request::post('nombreCompleto');
		$correo = Request::post('correo');
		$telefono = Request::post('telefono');
		$mensaje = Request::post('mensaje');
		$codigoVerificacion = sha1(uniqid(mt_rand(), true));
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL cobros_agregarCobro(:idComercio, :idUsuario,  :monto, :comision, :nombreCompleto, :correo, :telefono, :mensaje, :codigoVerificacion)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio,
							  ':idUsuario' => Session::get('idUsuario'),
							  ':monto' => $monto,
							  ':comision' => $comision,
							  ':nombreCompleto' => $nombreCompleto,
							  ':correo' => $correo,
							  ':telefono' => $telefono,
							  ':mensaje' => $mensaje,
							  ':codigoVerificacion' => $codigoVerificacion
							 )
					   );
		
		return $query->fetch();
	}
	
	public static function agregarPagoCobro($idCobro, $idPago)	
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cobros_agregarPagoCobro(:idCobro, :idPago)";
        $query = $database->prepare($sql);
        $query->execute(array(':idCobro' => $idCobro, ':idPago' => $idPago));

        return true;
	}
	
	public static function obtenerCobro($idCobro, $codigoVerificacion) 
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cobros_obtenerCobro(:idCobro, :codigoVerificacion)";
        $query = $database->prepare($sql);
        $query->execute(array(':idCobro' => $idCobro, ':codigoVerificacion' => $codigoVerificacion));

        return $query->fetch();
	}
	
	public static function obtenerCobroPorIdPago($idPago)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cobros_obtenerCobroPorIdPago(:idPago)";
        $query = $database->prepare($sql);
        $query->execute(array(':idPago' => $idPago));

        return $query->fetch();
	}
	
	public static function obtenerPagosCobro($idCobro) 
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cobros_obtenerPagosCobro(:idCobro)";
        $query = $database->prepare($sql);
        $query->execute(array(':idCobro' => $idCobro));

        return $query->fetchAll();
	}
	
	
	public static function realizarCobro()
	{	
		$idCobro = Request::post('idCobro');
		$terminalCode = Request::post('idTerminal');
		$merchantCode = Request::post('idComercio');
		$monto = Request::post('monto');
		$comision = Request::post('comision');
		$cardNumber = trim(Request::post('numeroTarjeta'));
		$expMonth = trim(Request::post('mes'));
		$expYear = trim(Request::post('ano'));
		$secCode = Request::post('cvv');
		$lastFour = substr($cardNumber, strlen($cardNumber)-4, 4);
		$cardHolder = trim(Request::post('tarjetahabiente'));
		$email = trim(Request::post('correo'));
		$phone = trim(Request::post('telefono'));
		$amount = $monto + $comision;
		$orderNumber = str_pad($idCobro, 5, "0", STR_PAD_LEFT);
		$codigoVerificacion = Request::post('codigoVerificacion');
		
		$notifyURL = "https://www.viabo.com/admin/notificarCobro";
		$cancelURL = "";
		$returnURL = "";

		$response = ViaboModel::procesarPagoTarjeta($idCobro, $amount, $orderNumber, $terminalCode, $merchantCode, $notifyURL, $cancelURL, $returnURL, $email, $phone, $cardNumber, $expMonth, $expYear, $secCode, $lastFour, $cardHolder);

		if ($response) {
			if ($response->successful) {

				if (($response->result_code == "00" || $response->result_code == "11") && $response->auth_code) {

					$database = DatabaseFactory::getFactory()->getConnection();

					$sql = "CALL cobros_actualizarEstatusCobro(:estatus, :respuesta, :idCobro)";
					$query = $database->prepare($sql);		
					$query->execute(array(':estatus' => "Completado",
										  ':respuesta' => json_encode($response),
										  ':idCobro' => $idCobro
										 )
								   );
					
					SMSModel::enviarSMS("+52" . $phone, "Tu transaccion ha sido aprobada exitosamente. Monto $ " . number_format($amount, 2, ".", ",") . " / Autorizacion " . $response->auth_code . ". En tu estado de cuenta aparecerá el cargo realizado por: BZPAYMX*ITRAVELMX");

					NotificacionesModel::enviarNotificacionCobro($idCobro, $codigoVerificacion);
					
					return (object) array("success" => 1, "message" => $response->display_message);

				} else {
					
					SMSModel::enviarSMS("+52" . $phone, "¡Algo salio mal! tu transaccion ha sido rechazada. Favor de llamar a su banco o intentar con otra tarjeta.");
					
					return (object) array("success" => 0, "error" => $response->result_code . ' - ' . $response->display_message . ' (' . $response->reference_number . ')');
				}

			} else {

				SMSModel::enviarSMS("+52" . $phone,  "¡Algo salio mal! tu transaccion ha sido rechazada. Favor de llamar a su banco o intentar con otra tarjeta.");
				
				return (object) array("success" => 0, "error" => $response->result_code . ' - ' . $response->display_message . ' (' . $response->reference_number . ')');
			}
		} else {
			
			$response = ViaboModel::cancelarPagoTarjeta($idCobro, $terminalCode, $merchantCode);

			SMSModel::enviarSMS("+52" . $phone,  "¡Algo salió mal! Cargo no procesado. Favor de intentarlo mas tarde.");
			
			return (object) array("success" => 0, "error" => "Error - Sin respuesta terminal (-1)");
		}

	}
}
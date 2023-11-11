<?php

class ViaboModel
{
	/*
	 * Pagos Pro
	 */
	public static function obtenerTarjetas()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL viabo_obtenerTarjetas()";
        $query = $database->prepare($sql);
		$query->execute();

        return $query->fetchAll();
	}
	
	public static function obtenerTarjeta($idTarjeta)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL viabo_obtenerTarjeta(:idTarjeta)";
        $query = $database->prepare($sql);
		$query->execute(array(':idTarjeta' => $idTarjeta));

        return $query->fetch();
	}
	
	public static function obtenerBalance($idTarjeta) 
	{
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
		
		// echo var_dump($token);
		
		$data = array(
			'inCardBalance' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCard' => $idTarjeta, // 43268002
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
				
		return json_decode($result);
	}
	
	public static function obtenerMovimientos($idTarjeta, $fechaInicio, $fechaTermino)
	{
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
		
		// echo var_dump($token);
		
		$data = array(
			'cardMove' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCard' => $idTarjeta, // 43268002
			'startDate' => $fechaInicio . " 00:00:00",
			'endDate' => $fechaTermino . " 23:59:59"
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
				
		return json_decode($result);
	}
	
	public static function transferirEntreTarjetas($idTarjetaEnvia, $idTarjetaRecibe, $monto)
	{
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
				
		$data = array(
			'moneyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCardOut' => $idTarjetaEnvia, // 43268002
			'binCardIn' => $idTarjetaRecibe,
			'Amount' => number_format($monto, 0, ".", "")
		);
				
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
				
		return json_decode($result);
	}
	
	public static function generarReferenciaPaynet()
    {
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
		
		// echo var_dump($token);
		

		$data = array(
			'payNet' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCard' => '43264001', // 43268002
			'Amount' => '1000.00'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$referencia = json_decode($result);
		
		echo var_dump($referencia);

		curl_close($ch);
		
	}
	
	public static function aplicarCargoTarjeta($idTarjeta, $monto, $concepto)
	{
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
		
		// echo var_dump($token);
		
		$data = array(
			'applyPay' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCard' => $idTarjeta, // 43268002
			'Amount' => number_format($monto, 0, ".", ""),
			'Description' => $concepto
		);
		
		// echo json_encode($data) . "<br />";
		
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		curl_close($ch);
				
		return json_decode($result);
		
		
		/* {"SystemTraceAuditNumber":"221121232815256","binCard":"43268002","Type_Id":"2","Amount":"100","Auth_Code":"513567","Merchant":"Cargo Viabo Admin","Date":"2022-11-21 17:28:13.000","Transaction_Id":"2526047"} */
	}
	
	public static function generarBin()
	{
		$url = 'https://bigonec.westus.cloudapp.azure.com/secure/integrador/API';

		$ch = curl_init($url);
		$data = array(
			'keyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321'
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		$token = json_decode($result);
		
		// echo var_dump($token);
		
		$data = array(
			'orderBin' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'merchantCode' => '707SFLJ6',
			'terminalCode' => '1101',
			'typeCard' => "0"
		);
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		
		// echo var_dump($result);
		
		curl_close($ch);
				
		return json_decode($result);
	}
	
	public static function obtenerMovimientosCuenta($idCuenta, $fechaInicio, $fechaTermino, $estatus)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL viabo_obtenerMovimientosCuenta(:idCuenta, :fechaInicio, :fechaTermino, :estatus)";
        $query = $database->prepare($sql);
		$query->execute(array(':idCuenta' => $idCuenta, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino, ':estatus' => $estatus));

        return $query->fetchAll();
	}
	
	/*
	 * Pharos
	 */
	
	public static function obtenerComercio($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL viabo_obtenerComercio(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetch()->comercio;
	}
	
	public static function obtenerComercios()
	{
		// $url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/merchants';
		$url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/merchants';

		$ch = curl_init($url);
		
		$headers = array(
			'Accept: application/json',
			'X-API-Key: eyJhbGciOiJIUzI1NiJ9.eyJidXNpbmVzc19jaGFpbl9pZCI6IiM8QnVzaW5lc3NDaGFpbjoweDAwMDA3ZjNhYWJkMmRjOTA-In0.Qm2CLNPOxhez8Hjr9X2Y1gNfNkwV1ZaEWSIur_DyVyQ'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (array) json_decode($response);
	}
	
	public static function obtenerTerminales($idComercio) 
	{
		// $url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/merchants/' . $idComercio . '/terminals';
		$url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/merchants/' . $idComercio . '/terminals';

		$ch = curl_init($url);
		
		$headers = array(
			'Accept: application/json',
			'X-API-Key: eyJhbGciOiJIUzI1NiJ9.eyJidXNpbmVzc19jaGFpbl9pZCI6IiM8QnVzaW5lc3NDaGFpbjoweDAwMDA3ZjNhYWJkMmRjOTA-In0.Qm2CLNPOxhez8Hjr9X2Y1gNfNkwV1ZaEWSIur_DyVyQ'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (array) json_decode($response);
	}
	
	public static function obtenerTerminal($idTerminal)
	{
		// $url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/terminals/' . $idTerminal;
		$url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/terminals/' . $idTerminal;

		$ch = curl_init($url);
		
		$headers = array(
			'Accept: application/json',
			'X-API-Key: eyJhbGciOiJIUzI1NiJ9.eyJidXNpbmVzc19jaGFpbl9pZCI6IiM8QnVzaW5lc3NDaGFpbjoweDAwMDA3ZjNhYWJkMmRjOTA-In0.Qm2CLNPOxhez8Hjr9X2Y1gNfNkwV1ZaEWSIur_DyVyQ'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (object) json_decode($response);
	}
	
	public static function obtenerTransacciones($idComercio, $idTerminal, $fechaInicio, $fechaTermino)
	{
		if ($idComercio == "-1") $idComercio = "";		
		if ($idTerminal == "-1") $idTerminal = "";	
		
		// $url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/transactions;
		$url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/transactions?fromDate=' . urlencode($fechaInicio) . '&toDate=' . urlencode($fechaTermino) . '&merchantId=' . $idComercio . '&terminalId=' . $idTerminal . '&page=1&pageSize=1000';
		
		$ch = curl_init($url);
		
		$headers = array(
			'Accept: application/json',
			'X-API-Key: eyJhbGciOiJIUzI1NiJ9.eyJidXNpbmVzc19jaGFpbl9pZCI6IiM8QnVzaW5lc3NDaGFpbjoweDAwMDA3ZjNhYWJkMmRjOTA-In0.Qm2CLNPOxhez8Hjr9X2Y1gNfNkwV1ZaEWSIur_DyVyQ'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (array) json_decode($response);
	    
	}
	
	public static function obtenerTransaccion($idTransaccion)
	{
		// $url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/transactions/' . $idTransaccion;
		$url = 'https://o3tkmwsybj.execute-api.us-west-2.amazonaws.com/v1_3/chains/transactions/' . $idTransaccion;

		$ch = curl_init($url);
		
		$headers = array(
			'Accept: application/json',
			'X-API-Key: eyJhbGciOiJIUzI1NiJ9.eyJidXNpbmVzc19jaGFpbl9pZCI6IiM8QnVzaW5lc3NDaGFpbjoweDAwMDA3ZjNhYWJkMmRjOTA-In0.Qm2CLNPOxhez8Hjr9X2Y1gNfNkwV1ZaEWSIur_DyVyQ'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (object) json_decode($response);
	}
	
	public static function procesarPagoTarjeta($stan, $amount, $orderNumber, $terminalCode, $merchantCode, $notifyURL, $cancelURL, $returnURL, $email, $phone, $cardNumber, $expMonth, $expYear, $secCode, $lastFour, $cardHolder) 
	{
		// $url = 'https://api-sandbox.pharospayments.com/gateway/charge';
		$url = 'https://api.pharospayments.com/payments/v1/charge';

		$ch = curl_init($url);
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		
		$data = array('tran_type' => 'SALE', // SALE = Venta, CANCEL = Cancelación, REFUND = Devolución
					  'stan' => $stan, // idCobro
					  'date' => date('YmdHis'), // 2020-08-29T09:12:33.001Z
					  'pos_environment' => 'ecommerce',
					  'amount' => number_format($amount, 2, ".", ""),
					  'currency' => '484', // MXN = 484
					  'order_number' => $orderNumber, // idCobro
					  'terminal_code' => $terminalCode,
					  'merchant_code' => $merchantCode,
					  'source_ip' => $ipAddress,
					  'notify_url' => $notifyURL, // "https://www.viabo.com/admin/notificarCobro",
					  'cancel_url' => $cancelURL,
					  'return_url' => $returnURL,
					  'email' => $email,
					  'phone' => $phone,
					  'language' => 'es',
					  'Card' => array('reading_method' => 'key_entry',
									  'card_number' => $cardNumber,
									  'exp_month' => $expMonth,
									  'exp_year' => $expYear,
									  'sec_code' => $secCode,
									  'last_four' => $lastFour,
									  'cardholder_name' => $cardHolder
									 )
					);
		
		$json = json_encode($data);
		
		$headers = array(
			'Content-Type: text/plain',
			'Content-length: ' . strlen($json),
			'Authorization: Basic fOzlSy1JUWCp71S'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (object) json_decode($response);
	}
	
	public static function cancelarPagoTarjeta($stan, $terminalCode, $merchantCode) 
	{
		// $url = 'https://api-sandbox.pharospayments.com/gateway/charge';
		$url = 'https://api.pharospayments.com/payments/v1/charge';

		$ch = curl_init($url);
		
		$data = array('tran_type' => 'VOID', // SALE = Venta, CANCEL = Cancelación, REFUND = Devolución
					  'stan' => $stan,
					  'terminal_code' => $terminalCode,
					  'merchant_code' => $merchantCode
					);
		
		$json = json_encode($data);
		
		$headers = array(
			'Content-Type: text/plain',
			'Content-length: ' . strlen($json),
			'Authorization: Basic fOzlSy1JUWCp71S'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch); 
		$curlErrno = curl_errno($ch); 
		$curlError = curl_error($ch); 
		
		curl_close($ch);
		
		if ($curlErrno) {
			return (object) array("success" => false,  "error" => "Error: " . $curlError . " (" . $curlErrno . ")");
		}
		
		return (object) json_decode($response);
	}
	
}
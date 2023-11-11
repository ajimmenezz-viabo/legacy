<?php

class TarjetasModel
{
    public static function obtenerTarjetas($idComercio)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tarjetas_obtenerTarjetas(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetchAll();
    }
	
	public static function obtenerTarjeta($idTarjeta)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tarjetas_obtenerTarjeta(:idTarjeta)";
        $query = $database->prepare($sql);
		$query->execute(array(':idTarjeta' => $idTarjeta));

        return $query->fetch();
	}
	
	public static function obtenerTarjetaPorIdTarjeta($idTarjeta)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tarjetas_obtenerTarjeta(:idTarjeta)";
        $query = $database->prepare($sql);
		$query->execute(array(':idTarjeta' => $idTarjeta));

        return $query->fetch()->tarjeta;
	}
	
	/*
	 * Pagos Pro
	 */
	
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
		
		// echo var_dump($token);
		
		$data = array(
			'moneyTrans' => true,
			'clientKey' => 'LOIK345ZXC4SRIWNDWQE321',
			'clientToken' => $token->AuthorizationCode,
			'binCardOut' => $idTarjetaEnvia, // 43268002
			'binCardIn' => $idTarjetaRecibe,
			'Amount' => $monto
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
}
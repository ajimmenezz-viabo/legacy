<?php

class PaybookModel
{
	public static function obtenerUsuarios()
	{	
		$response = Paybook\Sync\Sync::run(
			array("api_key" => Config::get('PAYBOOK_API_KEY')),
			'/users', 
			array(), 
			'GET'
		);
		
		return $response;
	}
	
	public static function crearUsuario()
	{	
		$response = Paybook\Sync\Sync::run(
			array("api_key" => Config::get('PAYBOOK_API_KEY')),
			'/users', 
			array(
				"id_external"=> '1798',
				"name"=> 'DESTINATION WORLD DAYS'
			), 
			'POST'
		);
		$id_user = $response->id_user;
		
		return $id_user;
	}
	
	public static function obtenerInstituciones()
	{
		// $id_user = "636053dfa1aa15407c0cb086"; // ITRAVELMX
		$id_user = "63b47369883f22592b1ccd0f"; // DWD
		
		$token = Paybook\Sync\Sync::auth(
			array("api_key" => Config::get('PAYBOOK_API_KEY')), 
			array("id_user"=> $id_user)
		);
		
		$response = Paybook\Sync\Sync::run(
			$token,
			"/catalogues/sites", 
			null,
			'GET'
		);
		
		return $response;
	}
	
	public static function obtenerCredencial()
	{
		
	}
	
	public static function consultarCredenciales()
	{
		// $id_user = "636053dfa1aa15407c0cb086"; // ITRAVELMX
		$id_user = "63b47369883f22592b1ccd0f"; // DWD
		
		$token = Paybook\Sync\Sync::auth(
			array("api_key" => Config::get('PAYBOOK_API_KEY')), 
			array("id_user"=> $id_user)
		);
		
		$response = Paybook\Sync\Sync::run(
			$token,
			"/credentials", 
			null,
			'GET'
		);
		
		return $response;
	}
	
	public static function obtenerTransacciones($idComercio, $idCuenta, $fechaInicio, $fechaTermino)
	{
		$tokenTWOFA = Request::post('tokenTWOFA');
		$tokenTWOFA = "708311";
		
		// $id_user = "636053dfa1aa15407c0cb086"; // ITRAVELMX
		$id_user = "63b47369883f22592b1ccd0f"; // DWD
		
		// $id_site = "5731fb37784806a6118b4571"; // SuperNet Personas
		// $id_site = "5a1cbf48056f2906304ba8e1"; // AfirmeNet Empresas
		$id_site = "5cae79b5f9de2a08897d7a21"; // Banregio Empresas
		
		$token = Paybook\Sync\Sync::auth(
			array("api_key" => Config::get('PAYBOOK_API_KEY')), 
			array("id_user"=> $id_user)
		);
		
		$payload = array("id_site" => $id_site);
		$response = Paybook\Sync\Sync::run(
			$token,
			"/catalogues/sites", 
			$payload,
			'GET'
		);
		
		$site = $response[0];
		$credentials = array();
		// SuperNet Personas
		/*
		$credentials[$site->credentials[0]->name] = "20323847";
		$credentials[$site->credentials[1]->name] = "C4m1N4ts";
		*/
		
		// AfirmeNet Empresas
		/*
		$credentials[$site->credentials[0]->name] = "2274700001";
		$credentials[$site->credentials[1]->name] = "CONTABI";
		$credentials[$site->credentials[2]->name] = "nata2021+";
		*/
		
		$credentials[$site->credentials[0]->name] = "Destination1";
		$credentials[$site->credentials[1]->name] = "Antonieta17";
		
		$payload['credentials'] = $credentials;
		
		$credential = Paybook\Sync\Sync::run(
			$token,
			"/credentials", 
			$payload,
			'POST'
		);	
		
		echo "Credentials: " . var_dump($credential) . "<br /><br />";
		
		// Consulta Status Credenciales twofa
		$id_job = $credential->id_job;
		// $id_job = "63b478bde9fadd5dca50eacf";
	
		$response = Paybook\Sync\Sync::run(
			$token,
			"/jobs/$id_job/status", 
			null,
			'GET'
		);
		
		echo "Status: " . var_dump($response) . "<br /><br />";
		
		$is_twofa = false;
		
		if($response[sizeof($response)-1]->code == 410) {
		  	$is_twofa = true;
		}
		
	 	if($is_twofa) {
			$twofaToken = array("twofa" => array());
			$twofaToken["twofa"][$response[1]->twofa[0]->name] = $tokenTWOFA;
			$twofa = Paybook\Sync\Sync::run(
				$token,
				"/jobs/$id_job/twofa", 
				$twofaToken, 
				'POST'
			);
			
			echo "TWOFA: " . var_dump($twofa) . "<br /><br />";
		}
		
		$count = 0;
		
		do {
			$response = Paybook\Sync\Sync::run(
				$token,
				"/jobs/$id_job/status", 
				null,
				'GET'
			);

			if ($count == 3) {
				 break;
			} 
			
			$count++;
			
			echo "Status: " . var_dump($response) . "<br /><br />";
			
		} while ($response[sizeof($response)-1]->code == 200);
		
		$id_credential = $credential->id_credential;
		$response = Paybook\Sync\Sync::run(
			$token,
			"/transactions", 
			array(
				"id_credential"=>$id_credential,
				"limit"=>200
			),
			'GET'
		);
		
		echo "Transacciones: " . var_dump($response) . "<br /><br />";
		
		return $response;
	}
	
}
<?php
	
	$post = json_decode(file_get_contents('php://input'), true);
		
	$clientKey = trim($post["clientKey"]);

	if ($clientKey == "000000000000") {

		
	} else {
		$return = array("SystemTraceAuditNumber" => "214232353554345",
						"ResponseCode" => "02",
					    "ErrorMessage" => "DEBE INTRODUCIR UNA CLAVE VALIDA");
	}

	echo header('Content-Type: application/json');
	echo json_encode($return);

?>
<?php

class ConciliacionesModel
{
	public static function obtenerTransaccionesCuentaConciliacion($idTransaccionTerminal, $idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL conciliaciones_obtenerTransaccionCuentaConciliacion(:idTransaccionTerminal, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTransaccionTerminal' => $idTransaccionTerminal, ':idComercio' => $idComercio));

        return $query->fetch();
	}
	
	public static function conciliarTransacciones()
	{
		$idTransaccionesTerminal = Request::post('idTransaccionesTerminal');
		$idTransaccionCuenta = 	Request::post('idTransaccionCuenta');
		$anotaciones = 	Request::post('anotaciones');
		
		if ($idTransaccionesTerminal) {		
			foreach ($idTransaccionesTerminal as $idTransaccionTerminal) {
		
				$database = DatabaseFactory::getFactory()->getConnection();

				$sql = "CALL conciliaciones_agregarConciliacion(:idUsuario, :idTransaccionTerminal, :idTransaccionCuenta, :anotaciones)";
				$query = $database->prepare($sql);
				$query->execute(array(':idUsuario' => Session::get('idUsuario'),
									  ':idTransaccionTerminal' => $idTransaccionTerminal,
									  ':idTransaccionCuenta' => $idTransaccionCuenta,
									  ':anotaciones' => $anotaciones
									 )
							   );
				
			}
		}
		
        return (object) array("success" => true, "idTransaccionesTerminal" => $idTransaccionesTerminal, "idTransaccionCuenta" => $idTransaccionCuenta);
	}
}
<?php

class CuentasModel
{
	public static function obtenerCuentas($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cuentas_obtenerCuentas(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetchAll();
	}
	
	public static function agregarTransaccionCuenta($idTransaccion, $idComercio, $idCuenta, $fecha, $concepto, $monto, $moneda, $extra, $referencia)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "CALL cuentas_agregarTransaccionCuenta(:idTransaccion, :idComercio, :idCuenta, :fecha, :concepto, :monto, :moneda, :extra, :referencia)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTransaccion' => $idTransaccion,
							  ':idComercio' => $idComercio,
							  ':idCuenta' => $idCuenta,
							  ':fecha' => $fecha,
							  ':concepto' => $concepto,
							  ':monto' => $monto,
							  ':moneda' => $moneda,
							  ':extra' => $extra,
							  ':referencia' => $referencia
							 )
					   );

        return true;
	}
	
	public static function obtenerTransaccionesCuenta($idCuenta, $idComercio)
	{	
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cuentas_obtenerTransaccionesCuenta(:idCuenta, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idCuenta' => $idCuenta, ':idComercio' => $idComercio));

        return $query->fetchAll();		
	}
	
	public static function obtenerTransaccionCuenta($idTransaccion, $idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL cuentas_obtenerTransaccionCuenta(:idTransaccion, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTransaccion' => $idTransaccion, ':idComercio' => $idComercio));

        return $query->fetch();
	}
}
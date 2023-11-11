<?php

class TerminalesModel
{
	public static function obtenerTerminales($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL terminales_obtenerTerminales(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetchAll();
	}
	
	public static function agregarTransaccionTerminal($idTransaccion, $idComercio, $idTerminal, $fecha, $monto, $stan, $autorizacion, $referencia, $aprobada, $reversada, $tarjeta, $emisor, $marca, $respuesta, $tipo, $conciliada, $liquidada, $estatus)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL terminales_agregarTransaccionTerminal(:idTransaccion, :idComercio, :idTerminal, :fecha, :monto, :stan, :autorizacion, :referencia, :aprobada, :reversada, :tarjeta, :emisor, :marca, :respuesta, :tipo, :conciliada, :liquidada, :estatus)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTransaccion' => $idTransaccion,
							  ':idComercio' => $idComercio,
							  ':idTerminal' => $idTerminal,
							  ':fecha' => $fecha,
							  ':monto' => $monto,
							  ':stan' => $stan,
							  ':autorizacion' => $autorizacion,
							  ':referencia' => $referencia,
							  ':aprobada' => $aprobada,
							  ':reversada' => $reversada,
							  ':tarjeta' => $tarjeta,
							  ':emisor' => $emisor,
							  ':marca' => $marca,
							  ':respuesta' => $respuesta,
							  ':tipo' => $tipo,
							  ':conciliada' => $conciliada,
							  ':liquidada' => $liquidada,
							  ':estatus' => $estatus
							 )
					   );

        return true;
	}
	
	public static function obtenerTransaccionesTerminal($idTerminal, $idComercio)
	{	
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL terminales_obtenerTransaccionesTerminal(:idTerminal, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTerminal' => $idTerminal, ':idComercio' => $idComercio));

        return $query->fetchAll();		
	}
	
	public static function obtenerTransaccionTerminal($idTransaccion, $idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL terminales_obtenerTransaccionTerminal(:idTransaccion, :idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idTransaccion' => $idTransaccion, ':idComercio' => $idComercio));

        return $query->fetch();
	}
}
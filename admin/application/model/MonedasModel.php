<?php

class MonedasModel
{
    public static function obtenerMonedas()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL monedas_obtenerMonedas()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public static function obtenerTipoCambio()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL monedas_obtenerTipoCambio()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetch()->tipoCambio;
	}
	
	public static function agregarTipoCambio($tipoCambio, $fecha)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL monedas_agregarTipoCambio(:tipoCambio, :fecha)";
        $query = $database->prepare($sql);
        $query->execute(array(':tipoCambio' => $tipoCambio, 
							  ':fecha' => $fecha));

        return $query->fetch()->tipoCambio;
	}
}
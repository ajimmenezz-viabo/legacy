<?php

class TiposModel
{
    public static function obtenerTipos()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tipos_obtenerTipos()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public static function obtenerTipoCambio()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tipos_obtenerTipoCambio()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetch()->tipoCambio;
    }
}
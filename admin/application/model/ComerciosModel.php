<?php

class ComerciosModel
{
	
	public static function obtenerComercios()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL comercios_obtenerComercios()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
	}
	
	public static function obtenerComercio($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL comercios_obtenerComercio(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetch();
	}
}
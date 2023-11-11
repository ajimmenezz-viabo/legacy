<?php

class EstadosModel
{
	public static function obtenerEstados($idPais = 1)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL estados_obtenerEstados(:idPais)";
        $query = $database->prepare($sql);
        $query->execute(array(':idPais' => $idPais));

        return $query->fetchAll();
	}
	
	public static function obtenerEstado($idEstado)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL estados_obtenerEstado(:idEstado)";
        $query = $database->prepare($sql);
        $query->execute(array(':idEstado' => $idEstado));

        return $query->fetch();
	}
}
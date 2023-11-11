<?php

class CiudadesModel
{
	public static function obtenerCiudades($idEstado, $local)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL ciudades_obtenerCiudades(:idEstado, :local)";
        $query = $database->prepare($sql);
        $query->execute(array(':idEstado' => $idEstado, ':local' => $local));

        return $query->fetchAll();
	}
}
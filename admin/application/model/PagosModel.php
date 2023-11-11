<?php

class PagosModel
{
	public static function obtenerComercio($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL comercios_obtenerComercio(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetch();
	}
}
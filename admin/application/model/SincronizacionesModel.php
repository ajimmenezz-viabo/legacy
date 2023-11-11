<?php

class SincronizacionesModel
{
	public static function agregarSincronizacion($idComercio)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL comercios_obtenerComercio(:idComercio)";
        $query = $database->prepare($sql);
        $query->execute(array(':idComercio' => $idComercio));

        return $query->fetch();
	}
}
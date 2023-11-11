<?php

class TareasModel
{
	public static function obtenerTareas($idUsuario, $estatus)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tareas_obtenerTareas(:idUsuario, :estatus)";
        $query = $database->prepare($sql);
		$query->execute(array(':idUsuario' => $idUsuario, ':estatus' => $estatus));

        return $query->fetchAll();
    }
	
	public static function obtenerUltimasTareas($idUsuario)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tareas_obtenerUltimasTareas(:idUsuario)";
        $query = $database->prepare($sql);
		$query->execute(array(':idUsuario' => $idUsuario));

        return $query->fetchAll();
	}
	
	public static function obtenerTareasPendientes($idUsuario)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL tareas_obtenerTareasPendientes(:idUsuario)";
        $query = $database->prepare($sql);
		$query->execute(array(':idUsuario' => $idUsuario));

        return $query->fetchAll();
	}
}
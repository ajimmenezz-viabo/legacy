<?php

class BuscadorModel
{	
	public static function obtenerIncidenciasResultadosBusqueda()
    {
		$palabraClave = trim(Request::get('term'));
		
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL buscador_obtenerIncidenciasResultadosBusqueda(:palabraClave)";
        $query = $database->prepare($sql);
		$query->execute(array(':palabraClave' => $palabraClave));

        return $query->fetchAll();
    }
}
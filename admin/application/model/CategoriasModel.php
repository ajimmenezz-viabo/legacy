<?php

class CategoriasModel
{
	public static function obtenerCategorias()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL categorias_obtenerCategorias()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
	}
	
	public static function agregarCategoria()
	{
		$categoria = strip_tags(trim(Request::post('idUsuario')));
		
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL categorias_agregarCategoria(:categoria)";
        $query = $database->prepare($sql);
        $query->execute(array(':categoria' => $categoria));

        return true;
	}
}
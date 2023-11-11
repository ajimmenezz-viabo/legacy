<?php

class PerfilesModel
{
    public static function obtenerPerfiles()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL perfiles_obtenerPerfiles()";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
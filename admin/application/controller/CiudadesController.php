<?php

class CiudadesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajaxObtenerCiudades($idEstado)
    {		
        $ciudades = CiudadesModel::obtenerCiudades($idEstado, -1);
		
		print json_encode($ciudades);
    }
}

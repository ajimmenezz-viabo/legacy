<?php

class EstadosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajaxObtenerEstados($idPais)
    {		
        $estados = EstadosModel::obtenerEstados($idPais);
		
		print json_encode($estados);
    }
}

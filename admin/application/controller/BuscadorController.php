<?php

class BuscadorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
		
		Auth::checarAutenticacion();
    }
	
    public function ajaxBuscarPorPalabraClave()
    {	
		$result = BuscadorModel::obtenerResultadosBusqueda();
		
		print json_encode($result);
    }
	
	public function ajaxBuscarProspectoPorPalabraClave()
    {	
		$result = BuscadorModel::obtenerProspectosResultadosBusqueda();
		
		print json_encode($result);
    }
	
	public function ajaxBuscarClientePorPalabraClave()
    {	
		$result = BuscadorModel::obtenerClientesResultadosBusqueda();
		
		print json_encode($result);
    }
	
	public function ajaxBuscarViajeroPorPalabraClave($idEmpresa = "")
    {	
		$result = BuscadorModel::obtenerViajerosResultadosBusqueda($idEmpresa);
		
		print json_encode($result);
    }
}
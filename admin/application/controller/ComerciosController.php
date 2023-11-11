<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class ComerciosController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checarAutenticacion();
    }
	
    public function index($idComercio = "1683")
    {
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$fechaInicio = "2022-01-01";
		$fechaTermino = "2022-09-30";
		
		$numeroDias = date('t');
		
        $this->View->render('comercios/index', array(
			'comercios' => ComerciosModel::obtenerComercios(),
			'idComercio' => $idComercio
		));
    }
}
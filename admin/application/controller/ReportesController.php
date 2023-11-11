<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class ReportesController extends Controller
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

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $this->View->render('reportes/index', array(
			
		));
    }
	
	public function comisiones($idComercio = "1683", $idTerminal = "-1", $fechaInicio = "", $fechaTermino = "")
	{
		if (Session::get('perfilUsuario') == "Super Administrador") {
			if (Session::get('idComercio')) {
				$idComercio = Session::get('idComercio');
			}
		} else {
			$idComercio = Session::get('idComercio');
		}
		
		$numeroDias = date('t');
		
		if ($fechaInicio == "") $fechaInicio = date('Y-m-01 00:00:00');
		if ($fechaTermino == "") $fechaTermino = date('Y-m-' . $numeroDias . " 23:59:59");
		
        $this->View->render('reportes/comisiones', array(
			'transacciones' => ViaboModel::obtenerTransacciones($idComercio, $idTerminal, $fechaInicio, $fechaTermino),
			'idComercio' => $idComercio,
			'idTerminal' => $idTerminal,
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino
		));
	}
}
<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class TableroController extends Controller
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
    public function index($idComercio = "1683")
    {
		if (Session::get('perfilUsuario') == "Super Administrador") {
			if (Session::get('idComercio')) {
				$idComercio = Session::get('idComercio');
			}
		} else {
			$idComercio = Session::get('idComercio');
		}
		
		$numeroDias = date('t');
		
		if ($fechaInicio == "") $fechaInicio = date('Y-m-01');
		if ($fechaTermino == "") $fechaTermino = date('Y-m-' . $numeroDias);
		
       	$this->View->render('tablero/index', array( 
			'transacciones' => ViaboModel::obtenerTransacciones($idComercio, -1, $fechaInicio, $fechaTermino),
			'comercio' => ComerciosModel::obtenerComercio($idComercio),
			'idComercio' => $idComercio,
		));
    }
	
	public function tarjetas($idComercio = "1683", $idTarjeta = "43268002")
    {
		if (Session::get('perfilUsuario') == "Super Administrador") {
			if (Session::get('idComercio')) {
				$idComercio = Session::get('idComercio');
			}
		} else {
			$idComercio = Session::get('idComercio');
		}
		
		$numeroDias = date('t');
		
		if ($fechaInicio == "") $fechaInicio = date('Y-m-01');
		if ($fechaTermino == "") $fechaTermino = date('Y-m-' . $numeroDias);
		
       	$this->View->render('tablero/tarjetas', array( 
			'tarjetas' => TarjetasModel::obtenerTarjetas($idComercio),
			'movimientos' => ViaboModel::obtenerMovimientos($idTarjeta, $fechaInicio, $fechaTermino),
			'idComercio' => $idComercio,
			'idTarjeta' => $idTarjeta
		));
    }
}

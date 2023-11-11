<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class MovimientosController extends Controller
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
	
    public function index($idComercio = "1683", $idTarjeta = "43268002", $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
    {
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$numeroDias = date('t');
		
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('2022-06-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
		$this->View->render('movimientos/index', array(
			'tarjeta' => TarjetasModel::obtenerTarjeta($idTarjeta),
			'tarjetas' => TarjetasModel::obtenerTarjetas($idComercio),
			'movimientos' => ViaboModel::obtenerMovimientos($idTarjeta, $fechaInicio, $fechaTermino),
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'idComercio' => $idComercio,
			'idTarjeta' => $idTarjeta
		));
    }
	
	public function obtenerMovimientosDinamica($idTarjeta = -1, $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
	{
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('2021-06-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
		$tarjeta = ViaboModel::obtenerTarjeta($idTarjeta);
		
		$this->View->renderWithoutHeaderAndFooter('movimientos/detalled', array(
			'tarjeta' => TarjetaModel::obtenerTarjeta($idTarjeta),
			'movimientos' => ViaboModel::obtenerMovimientos($tarjeta->binCard, $fechaInicio, $fechaTermino),
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'idComercio' => $idComercio,
			'idTarjeta' => $idTarjeta,
		));
	}
	
}
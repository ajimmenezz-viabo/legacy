<?php

class ConciliacionesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        Auth::checarAutenticacion();
    }
	
    public function index($idComercio = "1683", $idTerminal = "", $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
    {
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('Y-10-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
        $this->View->render('conciliaciones/index', array(
			'transaccionesTerminal' => TerminalesModel::obtenerTransaccionesTerminal(-1, $idComercio),
			'transaccionesCuenta' => CuentasModel::obtenerTransaccionesCuenta(-1, $idComercio),
			'idComercio' => $idComercio
		));
    }
	
	public function historialConciliaciones($idComercio = "1683", $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
    {
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('Y-10-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
        $this->View->render('conciliaciones/historial', array(
			'conciliaciones' => ConciliacionesModel::obtenerConciliaciones($idComercio, $fechaInicio, $fechaTermino),
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'idComercio' => $idComercio
		));
    }
	
	public function confirmarPrevioConciliaciones()
	{
		$this->View->renderWithoutHeaderAndFooter('conciliaciones/confirmar', array());
	}
	
	public function conciliarTransacciones()
	{
		$result = ConciliacionesModel::conciliarTransacciones();
		
		print json_encode($result);
	}
}

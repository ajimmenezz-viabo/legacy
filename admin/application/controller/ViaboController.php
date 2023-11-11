<?php

class ViaboController extends Controller
{
	public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checarAutenticacion();
    }
	
	public function dinamica()
	{
		$this->View->render('viabo/indexd', array(
			'tarjetas' => ViaboModel::obtenerTarjetas(),
			'terminales' => ViaboModel::obtenerTerminales()
		));
	}
	
	public function obtenerTransaccionesDinamica($idTerminal = -1, $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00", $estatus = "0")
	{
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('Y-m-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
		$this->View->renderWithoutHeaderAndFooter('viabo/transaccionesd', array(
			'terminal' => ViaboModel::obtenerTerminal($idTerminal),
			'transacciones' => ViaboModel::obtenerTransacciones($idTerminal, $fechaInicio, $fechaTermino, $estatus),
			'idTerminal' => $idTerminal,
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'estatus' => $estatus
		));
	}
	
	public function obtenerMovimientosDinamica($idTarjeta = -1, $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00", $estatus = "0")
	{
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('Y-m-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
		$this->View->renderWithoutHeaderAndFooter('viabo/movimientosd', array(
			'tarjeta' => ViaboModel::obtenerTarjeta($idTarjeta),
			'movimientos' => ViaboModel::obtenerMovimientos($idTarjeta, $fechaInicio, $fechaTermino, $estatus),
			'idTarjeta' => $idTarjeta,
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'estatus' => $estatus
		));
	}
	
	public function aplicarCargoTarjeta()
	{
		$result = ViaboModel::aplicarCargoTarjeta("43268002", "100", "Cargo Viabo Admin");
		
		print json_encode($result);
	}
	
	public function obtenerComercios()
	{
		$result = ViaboModel::obtenerComercios();
		
		print json_encode($result);
	}
	
	public function obtenerTerminales($idComercio)
	{
		$result = ViaboModel::obtenerTerminales($idComercio);
		
		print json_encode($result);
	}
	
	public function obtenerTransacciones($idComercio, $idTerminal, $fechaInicio, $fechaTermino)
	{
		$result = ViaboModel::obtenerTransacciones($idComercio, $idTerminal, $fechaInicio, $fechaTermino);
		
		print json_encode($result);
	}
	
	public function obtenerTransaccion($idTransaccion)
	{
		$result = ViaboModel::obtenerTransaccion($idTransaccion);
		
		print json_encode($result);
	}
	
	public function generarReferenciaPaynet()
	{
		$result = ViaboModel::generarReferenciaPaynet();
		
		// print json_encode($result);
		
	}

}
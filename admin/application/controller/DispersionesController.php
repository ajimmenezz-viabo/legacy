<?php

class DispersionesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        Auth::checarAutenticacion();
    }
	
    public function index($idComercio = "1683", $idTarjetaOrigen = -1, $idTarjetaDestino = -1, $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
    {
		if (Session::get('idComercio')) {
			$idComercio = Session::get('idComercio');
		} 
		
		$numeroDias = date('t');
		if ($fechaInicio == "0000-00-00") $fechaInicio = date('Y-m-01');
		if ($fechaTermino == "0000-00-00") $fechaTermino = date('Y-m-' . $numeroDias);
		
        $this->View->render('dispersiones/index', array(
			'dispersiones' => DispersionesModel::obtenerDispersiones($idComercio, $idTarjetaOrigen, $idTarjetaDestino, $fechaInicio, $fechaTermino),
			'fechaInicio' => $fechaInicio,
			'fechaTermino' => $fechaTermino,
			'idTarjetaOrigen' => $idTarjetaOrigen,
			'idTarjetaDestino' => $idTarjetaDestino,
			'idComercio' => $idComercio,
		));
    }
	
	public function nuevaDispersion($idComercio, $idTarjeta)
    {
		Auth::checarAutenticacion();
		
        $this->View->renderWithoutHeaderAndFooter('dispersiones/nueva', array(
			'tarjetas' => TarjetasModel::obtenerTarjetas($idComercio),
			'idComercio' => $idComercio,
			'idTarjeta' => $idTarjeta
		));
    }
	
	public function agregarDispersion()
	{
		$result = DispersionesModel::agregarDispersion();
		
		print json_encode($result);
	}
}

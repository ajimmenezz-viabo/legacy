<?php

class CobrosController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Auth::checarAutenticacion();
    }
	
    public function nuevoCobro($idComercio)
    {
		Auth::checarAutenticacion();
		
        $this->View->renderWithoutHeaderAndFooter('cobros/ligad', array(
			'idComercio' => $idComercio
		));
    }
	
	public function agregarCobro()
	{
		Auth::checarAutenticacion();
		
		$result = CobrosModel::agregarCobro();
		
		print json_encode($result);
	}
	
	public function terminarVirtual($idComercio)
    {
		Auth::checarAutenticacion();
		
        $this->View->renderWithoutHeaderAndFooter('cobros/terminald', array(
			'idComercio' => $idComercio
		));
    }
	
	public function referenciaComercio($idComercio)
    {
		Auth::checarAutenticacion();
		
        $this->View->renderWithoutHeaderAndFooter('cobros/referenciad', array(
			'idComercio' => $idComercio
		));
    }
	
	public function cliente($idCobro, $codigoVerificacion)
	{
		$this->View->renderWithoutHeaderAndFooter('cobros/cliente', array(
			'cobro' => CobrosModel::obtenerCobro($idCobro, $codigoVerificacion),
			'idCobro' => $idCobro,
			'codigoVerificacion' => $codigoVerificacion
		));
	}
	
	public function realizarCobro()
	{
		$result = CobrosModel::realizarCobro();
		
		print json_encode($result);
	}
}
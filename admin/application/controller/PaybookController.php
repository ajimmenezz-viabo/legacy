<?php

class PaybookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
		
		Auth::checarAutenticacion();
    }
	
    public function obtenerUsuarios()
    {	
		$result = PaybookModel::obtenerUsuarios();
		
		print json_encode($result);
    }
	
	public function crearUsuario()
    {	
		$result = PaybookModel::crearUsuario();
		
		print json_encode($result);
    }
	
	public function consultarCredenciales()
    {	
		$result = PaybookModel::consultarCredenciales();
		
		print json_encode($result);
    }
	
	public function obtenerInstituciones()
    {	
		$result = PaybookModel::obtenerInstituciones();
		
		print json_encode($result);
    }
	
	public function autentificacion2Factores()
	{
		$this->View->renderWithoutHeaderAndFooter('paybook/token', array());
	}
	
	public function obtenerTransacciones($idComercio = -1, $idCuenta = -1, $fechaInicio = "0000-00-00", $fechaTermino = "0000-00-00")
    {	
		$result = PaybookModel::obtenerTransacciones($idComercio, $idCuenta, $fechaInicio, $fechaTermino);
		
		print json_encode($result);
    }
}
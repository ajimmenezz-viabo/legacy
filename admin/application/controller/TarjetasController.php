<?php

class TarjetasController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerTarjetaPorIdTarjeta($idTarjeta)
    {		
        $tarjeta = TarjetasModel::obtenerTarjetaPorIdTarjeta($idTarjeta);
		
		echo $tarjeta;
    }
	
	public function fondeoTarjetas()
    {
		Auth::checarAutenticacion();
		
        $this->View->render('tarjetas/fondeo', array(
			
		));
    }
	
	public function generarBin()
    {		
        $result = ViaboModel::generarBin();
		
		echo var_dump($result);
    }
}

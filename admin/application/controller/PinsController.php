<?php

class PinsController extends Controller
{
	public function nuevoPin($tipo, $idTipo)
	{
        $this->View->renderWithoutHeaderAndFooter('pin/nuevo', array(
			'usuarios' => UsuariosModel::obtenerUsuarios(0),
			'tipo' => $tipo,
			'idTipo' => $idTipo
		));
    }
	
	public function nuevoPinDinamica($tipo, $idTipo)
	{
        $this->View->renderWithoutHeaderAndFooter('pin/nuevod', array(
			'usuarios' => UsuariosModel::obtenerUsuarios(0),
			'tipo' => $tipo,
			'idTipo' => $idTipo
		));
    }
	
	public function ajaxAgregarPin()
	{
		$result = PinsModel::agregarPin();
		
		print json_encode($result);
	}
	
	public function ajaxRemoverPin($idPin)
	{
		$result = PinsModel::removerPin($idPin);
		
		print json_encode($result);
	}

}
<?php

class IncidenciasController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        Auth::checarAutenticacion();
    }
	
    public function index($idIncidencia = "")
    {
		if (Session::get('perfilUsuario') == "Super Administrador") {
			$idUsuario = -1;
		} else {
			$idUsuario = Session::get('idUsuario');
		}
		
		if (Session::get('perfilUsuario') == "Super Administrador") {
			if (Session::get('idComercio')) {
				$idComercio = Session::get('idComercio');
			} else {
				$idComercio = -1;
			}
		} else {
			$idComercio = Session::get('idComercio');
		}
		
        $this->View->render('incidencias/index', array(
			'incidencias' => IncidenciasModel::obtenerIncidencias($idComercio, $idUsuario, "-1", ""),
			'usuarios' => UsuariosModel::obtenerUsuarios(0, -1),
			'categorias' => CategoriasModel::obtenerCategorias(),
			'idIncidencia' => $idIncidencia
		));
    }
	
	public function nuevaIncidencia($idComercio, $tipo, $idTipo)
    {		
        $this->View->renderWithoutHeaderAndFooter('incidencias/nueva', array(
			'categorias' => CategoriasModel::obtenerCategorias(),
			'usuarios' => UsuariosModel::obtenerUsuarios(0, -1),
			'idComercio' => $idComercio,
			'tipo' => $tipo,
			'idTipo' => $idTipo
		));
    }
	
	public function agregarIncidencia()
	{
		$result = IncidenciasModel::agregarIncidencia();
		
		print json_encode($result);
	}
	
	public function editarIncidencia($idIncidencia, $idComercio)
    {		
        $this->View->renderWithoutHeaderAndFooter('incidencias/editar', array(
			'incidencia' => IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio),
			'categorias' => CategoriasModel::obtenerCategorias(),
			'usuarios' => UsuariosModel::obtenerUsuarios(0, -1),
			'idComercio' => $idComercio,
			'idIncidencia' => $idIncidencia,
		));
    }
	
	public function actualizarIncidencia()
	{
		$result = IncidenciasModel::actualizarIncidencia();
		
		print json_encode($result);
	}
	
	public function cerrarIncidencia($idIncidencia, $idComercio)
    {		
        $this->View->renderWithoutHeaderAndFooter('incidencias/cerrar', array(
			'incidencia' => IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio),
			'idComercio' => $idComercio,
			'idIncidencia' => $idIncidencia,
		));
    }
	
	public function terminarIncidencia()
	{
		$result = IncidenciasModel::terminarIncidencia();
		
		print json_encode($result);
	}
	
	public function detalleIncidencia($idIncidencia, $idComercio)
	{
		$this->View->renderWithoutHeaderAndFooter('incidencias/detalle', array(
			'incidencia' => IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio),
			'anotaciones' => IncidenciasModel::obtenerAnotacionesIncidencia($idIncidencia, "-1"),
			'usuarios' => IncidenciasModel::obtenerUsuariosIncidencia($idIncidencia),
			'idIncidencia' => $idIncidencia,
			'idComercio' => $idComercio
		));
	}
	
	public function nuevaAnotacionIncidencia($idIncidencia, $idComercio)
    {		
        $this->View->renderWithoutHeaderAndFooter('incidencias/anotacion', array(
			'incidencia' => IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio),
			'idComercio' => $idComercio,
			'idIncidencia' => $idIncidencia,
		));
    }
	
	public function agregarAnotacionIncidencia()
	{
		$result = IncidenciasModel::agregarAnotacionIncidencia();
		
		print json_encode($result);
	}
	
	public function nuevoUsuarioIncidencia($idIncidencia, $idComercio)
	{
		$this->View->renderWithoutHeaderAndFooter('incidencias/usuario', array(
			'incidencia' => IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio),
			'asignados' => IncidenciasModel::obtenerUsuariosIncidencia($idIncidencia),
			'usuarios' => UsuariosModel::obtenerUsuarios(0, -1),
			'idIncidencia' => $idIncidencia,
			'idComercio' => $idComercio
		));
	}
	
	public function agregarUsuarioIncidencia()
	{
		$result = IncidenciasModel::agregarUsuarioIncidencia();
		
		print json_encode($result);
	}
}

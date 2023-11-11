<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class TareasController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        // Auth::checarAutenticacion();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index($idUsuario = -1)
    {
		if (Session::get('perfilUsuario') == "Asesor") {
			$idUsuario = Session::get('idUsuario');
		}
		
        $this->View->render('tareas/index', array(
			'pendientes' => TareasModel::obtenerTareas($idUsuario, "Pendiente"),
			'proceso' => TareasModel::obtenerTareas($idUsuario, "En Proceso"),
			'completadas' => TareasModel::obtenerTareas($idUsuario, "Completada"),
			'recientes' => TareasModel::obtenerUltimasTareas($idUsuario)
		));
    }
	
	public function nuevaTareaDinamica($tipo)
	{
		 $this->View->renderWithoutHeaderAndFooter('tareas/nuevad', array(
			'tipo' => $tipo
		));
	}
}

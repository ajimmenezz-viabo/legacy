<?php

class UsuariosModel
{
	public static function obtenerUsuarios($idSucursal = 0, $idPerfil = 0)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL usuarios_obtenerUsuarios(:idSucursal, :idPerfil)";
        $query = $database->prepare($sql);
		$query->execute(array(':idSucursal' => $idSucursal, ':idPerfil' => $idPerfil));

        return $query->fetchAll();
    }
	
	public static function obtenerUsuariosReciente($idSucursal = 0, $idPerfil = 0)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL usuarios_obtenerUsuariosReciente(:idSucursal, :idPerfil)";
        $query = $database->prepare($sql);
		$query->execute(array(':idSucursal' => $idSucursal, ':idPerfil' => $idPerfil));

        return $query->fetchAll();
    }
	
	public static function obtenerUsuario($idUsuario)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("CALL usuarios_obtenerUsuario(:idUsuario)");
        $query->execute(array(':idUsuario' => $idUsuario));

        return $query->fetch();
    }
	
    public static function obtenerUsuarioPorUsuario($usuario)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("CALL usuarios_obtenerUsuarioPorUsuario(:usuario)");
        $query->execute(array(':usuario' => $usuario));

        return $query->fetch();
    }
	
	public static function obtenerIdSucursalPorIdUsuario($idUsuario) 
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("CALL usuarios_obtenerIdSucursalPorIdUsuario(:idUsuario)");
        $query->execute(array(':idUsuario' => $idUsuario));

        return $query->fetch()->idSucursal;
	}
	
    public static function agregarUsuario()
	{
		$idSucursal = Request::post('idSucursal');
		$idPerfil = Request::post('idPerfil');
		$iniciales = strip_tags(Request::post('iniciales'));
		$nombre = strip_tags(trim(Request::post('nombre')));
		$correo = strip_tags(trim(Request::post('correo')));
		$whatsapp = strip_tags(trim(Request::post('whatsapp')));
		$usuario = strip_tags(trim(Request::post('usuario')));
		$contrasena = strip_tags(trim(Request::post('contrasena')));
		
		$validationResult = self::validarAgregarUsuario($idSucursal, $idPerfil, $iniciales, $nombre, $correo, $whatsapp, $usuario, $contrasena);
        if (!$validationResult) {
            return false;
        }	
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL usuarios_agregarUsuario(:idSucursal, :idPerfil, :iniciales, :nombre, :correo, :whatsapp, :usuario, :contrasena)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, 
							  ':idPerfil' => $idPerfil, 
							  ':iniciales' => $iniciales, 
							  ':nombre' => $nombre, 
							  ':correo' => $correo, 
							  ':whatsapp' => $whatsapp,
							  ':usuario' => $usuario, 
							  ':contrasena' => password_hash($contrasena, PASSWORD_DEFAULT)
							 )
					   );
		
		Session::add('feedback_positive', Text::get('FEEDBACK_USUARIO_AGREGADO_EXITO'));
		return true;
	}
	
	public static function validarAgregarUsuario($idSucursal, $idPerfil, $iniciales, $nombre, $correo, $whatsapp, $usuario, $contrasena)
	{
		$return = true;
		
		return $return;
	}
	
	public static function validarExisteUsuario($usuario)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT idUsuario FROM usuarios WHERE usuario = :usuario LIMIT 1");
        $query->execute(array(':usuario' => $usuario));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }
	
    public static function validarExisteCorreo($correo)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT idUsuario FROM usuarios WHERE correo = :correo LIMIT 1");
        $query->execute(array(':correo' => $correo));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }
	
	public static function actualizarUsuario()
	{
		$idSucursal = Request::post('idSucursal');
		$idPerfil = Request::post('idPerfil');
		$iniciales = strip_tags(Request::post('iniciales'));
		$nombre = strip_tags(trim(Request::post('nombre')));
		$correo = strip_tags(trim(Request::post('correo')));
		$whatsapp = strip_tags(trim(Request::post('whatsapp')));
		$idUsuario = Request::post('idUsuario');
		
		$validationResult = self::validarActualizarUsuario($idSucursal, $idPerfil, $iniciales, $nombre, $correo, $whatsapp, $idUsuario);
        if (!$validationResult) {
            return false;
        }	
		
		$database = DatabaseFactory::getFactory()->getConnection();
		
        $sql = "CALL usuarios_actualizarUsuario(:idSucursal, :idPerfil, :iniciales, :nombre, :correo, :idUsuario)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, 
							  ':idPerfil' => $idPerfil, 
							  ':iniciales' => $iniciales, 
							  ':nombre' => $nombre, 
							  ':correo' => $correo, 
							  ':whatsapp' => $whatsapp,
							  ':idUsuario' => $idUsuario
							 )
					   );
		
		Session::add('feedback_positive', Text::get('FEEDBACK_USUARIO_ACTUALIZADO_EXITO'));
		return true;
	}
	
	public static function validarActualizarUsuario($idSucursal, $idPerfil, $iniciales, $nombre, $correo, $whatsapp, $idUsuario)
	{
		$return = true;
		
		return $return;
	}

}

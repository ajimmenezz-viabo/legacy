<?php

class ReportesModel
{	
	public static function obtenerSolicitudes($idUsuario, $estatus, $idFuente, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerSolicitudes(:idUsuario, :estatus, :idFuente, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario, ':estatus' => $estatus, ':idFuente' => $idFuente, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerReservaciones($idUsuario, $estatus, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerReservaciones(:idUsuario, :estatus, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario, ':estatus' => $estatus, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerUtilidades($idUsuario, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerUtilidades(:idUsuario, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerServiciosFinanciados($idUsuario)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerServiciosFinanciados(:idUsuario)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario));

        return $query->fetchAll();
	}

	public static function obtenerPagos($idSucursal, $idUsuario, $idMetodoPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerPagos(:idSucursal, :idUsuario, :idMetodoPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, ':idUsuario' => $idUsuario, ':idMetodoPago' => $idMetodoPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerCompras($idSucursal, $idUsuario, $idFormaPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerCompras(:idSucursal, :idUsuario, :idFormaPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, ':idUsuario' => $idUsuario, ':idFormaPago' => $idFormaPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerServiciosPorViajar($idUsuario, $idTipo, $idProveedor, $estatus, $dias)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerServiciosPorViajar(:idUsuario, :idTipo, :idProveedor, :estatus, :dias)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario, ':idTipo' => $idTipo, ':idProveedor' => $idProveedor, ':estatus' => $estatus, ':dias' => $dias));

        return $query->fetchAll();
	}
	
	public static function obtenerGastos($idFormaPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerGastos(:idFormaPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idFormaPago' => $idFormaPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerEgresos($idMetodoPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerEgresos(:idMetodoPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idMetodoPago' => $idMetodoPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerIngresos($idMetodoPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerIngresos(:idMetodoPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idMetodoPago' => $idMetodoPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerNominas($idSucursal, $idUsuario, $idFormaPago, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerNominas(:idSucursal, :idUsuario, :idFormaPago, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, ':idUsuario' => $idUsuario, ':idFormaPago' => $idFormaPago, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerFacturacion($idUsuario, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerFacturacion(:idUsuario, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idUsuario' => $idUsuario, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
		
	
	public static function obtenerMovimientosTarjetas($idSucursal, $idUsuario, $idTarjeta, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerMovimientosTarjetas(:idSucursal, :idUsuario, :idTarjeta, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idSucursal' => $idSucursal, ':idUsuario' => $idUsuario, ':idTarjeta' => $idTarjeta, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerDestinos($fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerDestinos(:fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
	
	public static function obtenerHoteles($idDestino, $fechaInicio, $fechaTermino)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL reportes_obtenerHoteles(:idDestino, :fechaInicio, :fechaTermino)";
        $query = $database->prepare($sql);
        $query->execute(array(':idDestino' => $idDestino, ':fechaInicio' => $fechaInicio, ':fechaTermino' => $fechaTermino));

        return $query->fetchAll();
	}
}
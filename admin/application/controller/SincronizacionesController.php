<?php

class SincronizacionesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	
    public function sincronizarTransaccionesTerminales($idComercio = "1683") 
	{
		$idTerminal = -1;
		$fechaInicio = "2022-11-10";
		$fechaTermino = "2022-11-15";
		
		$transacciones = ViaboModel::obtenerTransacciones($idComercio, $idTerminal, $fechaInicio, $fechaTermino);
		
		if ($transacciones["items"]) {
			foreach ($transacciones["items"] as $transaccion) {
				$result = TerminalesModel::agregarTransaccionTerminal($transaccion->id, $idComercio, $transaccion->terminal_id, $transaccion->transaction_date, $transaccion->amount, $transaccion->stan, $transaccion->authorization_number, $transaccion->reference, $transaccion->approved, $transaccion->reversed, $transaccion->card_number, $transaccion->issuer, $transaccion->card_brand, $transaccion->result_code, $transaccion->card_type, $transaccion->conciliated, $transaccion->paid, "Pendiente");
			}
		}
		
		Redirect::to('conciliaciones');
	}
	
	public function sincronizarTransaccionesCuentas($idComercio = "1683")
	{
		$idCuenta = -1;
		$fechaInicio = "2022-10-01";
		$fechaTermino = "2022-11-09";
		$extra = "";
		
		$transacciones = PaybookModel::obtenerTransacciones($idComercio, $idCuenta, $fechaInicio, $fechaTermino);
		
		if ($transacciones) {
			foreach ($transacciones as $transaccion) {
				$extra = json_encode($transaccion->extra);
					
				$retult = CuentasModel::agregarTransaccionCuenta($transaccion->id_transaction, $idComercio, $transaccion->id_account, date('Y-m-d h:i:s', $transaccion->dt_transaction), $transaccion->description, $transaccion->amount, $transaccion->currency, $extra, $transaccion->reference);
			}
		}
		
		Redirect::to('conciliaciones');
	}
}
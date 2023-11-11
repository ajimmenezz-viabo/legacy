<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checarAutenticacion(); in line 16)
 */
class SMSController extends Controller
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
	
	public function enviarSMS()
    {
        $result = SMSModel::enviarSMS();

	}
	
	public function reporteEnvioSMS()
	{
		$result = SMSModel::reporteEnvioSMS();
	}
}
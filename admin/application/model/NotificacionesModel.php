<?php

class NotificacionesModel
{	

	public static function enviarNotificacionCobro($idCobro, $codigoVerificacion)
	{
		$cobro = CobrosModel::obtenerCobro($idCobro, $codigoVerificacion);
		$comercio = ComerciosModel::obtenerComercio($cobro->idComercio);
		
		$respuesta = json_decode($cobro->respuesta);
		
		$html = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>Viabo</title>
					</head>
						<style type="text/css">x
							body {margin: 0; padding: 0; min-width: 100%;  font-size: 15px; line-height: normal; color: #989ca1;}
							table{width: 100%; max-width: 600px;}
							.content, .info, .header{padding: 10px 30px;}
							.top, .contacto{padding: 20px 20px; color: #FFF;}
							p{font-size: 15px; margin-bottom: 5px;}
							h2, h3{margin: 0; padding: 0;}
							a{text-decoration: none;}
						</style>
						<body yahoo bgcolor="#f2f4f8" style="font-family: Arial, Sans-serif;">
							<table width="600" bgcolor="#f2f4f8" border="0" cellpadding="0" cellspacing="0" align="center">
								<tr>
									<td>
										<table width="100%"  class="header" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#f2f4f8">
											<tr>
												<td width="100%">
													<center><img src="https://www.viabo.com/admin/img/logo-big.png" width="150" /></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#FFF">
											<tr>
												<td width="100%">
													<p>&iexcl;Hola ' . $comercio->comercio . '! hemos recibido un pago de <strong>' . Text::title($cobro->nombreCompleto) . '</strong> por medio de tarjeta de crédito en línea.</p>
												</td>
											</tr>
											<tr>
												<td width="100%" style="text-align: center;">
													<br />
													<h2>$' . number_format($cobro->monto, 2, ".", ",") . ' <small>MXN</small></h2>
													<p><strong>Autorización:</strong> ' . $respuesta->auth_code . '</p>
													<br />
													<br />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="10" cellspacing="0" border="0" bgcolor="#f2f4f8">
											<tr>
												<td width="100%">
													<center><small><i>Notificación automática favor de no responder a este correo</i></small></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</body>
					</html>';
	
		$mailSent = false;
			
		$mail = new Mail;
		$mailSent = $mail->sendMail("amf@3doubleu.com", "no-responder@itravel.mx", "Viabo 💳", "Pago en línea $" . number_format($cobro->monto, 2, ".", ",") . " de " . Text::title($cobro->nombreCompleto) , $html, $attachment);
		$mailSent = $mail->sendMail("ramses@itravel.mx", "no-responder@itravel.mx", "Viabo 💳", "Pago en línea $" . number_format($cobro->monto, 2, ".", ",") . " de " . Text::title($cobro->nombreCompleto) , $html, $attachment);
		
		if ($mailSent) {
			return array("success" => true);
		} else {
			return array("success" => false, "error" => $mail->getError());
		}
	}
	
	public static function enviarNotificacionPagoComercio($referencia, $monto)
	{
		$html = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>itravel</title>
					</head>
						<style type="text/css">x
							body {margin: 0; padding: 0; min-width: 100%;  font-size: 15px; line-height: normal; color: #989ca1;}
							table{width: 100%; max-width: 600px;}
							.content, .info, .header{padding: 10px 30px;}
							.top, .contacto{padding: 20px 20px; color: #FFF;}
							p{font-size: 15px; margin-bottom: 5px;}
							h2, h3{margin: 0; padding: 0;}
							a{text-decoration: none;}
						</style>
						<body yahoo bgcolor="#f8f8fb" style="font-family: Arial, Sans-serif;">
							<table width="600" bgcolor="#f8f8fb" border="0" cellpadding="0" cellspacing="0" align="center">
								<tr>
									<td>
										<table width="100%"  class="header" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><img src="https://www.itravel.mx/img/logo-dark.png" width="160" /></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#FFF">
											<tr>
												<td width="100%">
													<p>&iexcl;Hola itravel! hemos recibido un pago por medio de referencia en comercios.</p>
												</td>
											</tr>
											<tr>
												<td width="100%" style="text-align: center;">
													<br />
													<h2>$' . number_format($monto, 2, ".", ",") . ' <small>MXN</small></h2>
													<p><strong>Referencia:</strong> ' . $refencia . '</p>
													<br />
													<br />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="10" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><small><i>Notificación automática favor de no responder a este correo</i></small></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</body>
					</html>';
	
		$mailSent = false;
			
		$mail = new Mail;
		// $mailSent = $mail->sendMail("amf@3doubleu.com", "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
		$mailSent = $mail->sendMail("ramses@itravel.mx", "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
		$mailSent = $mail->sendMail("diego@itravel.mx", "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
		$mailSent = $mail->sendMail("contabilidad@itravel.mx", "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
		$mailSent = $mail->sendMail("pagos@itravel.mx", "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
		
		/*
		if ($pago->idReservacion) {
			// $mailSent = $mail->sendMail($reservacion->correoAsesor, "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
			
			if ($reservacion->correoSecundario) {
				// $mailSent = $mail->sendMail($reservacion->correoSecundario, "no-responder@itravel.mx", "itravel 💰", "Pago RC $" . number_format($pago->monto, 2, ".", ","), $html, $attachment);
			}
		}
		*/
		
		if ($mailSent) {
			return array("success" => true);
		} else {
			return array("success" => false, "error" => $mail->getError());
		}
	}
	
	/* 
	 * Incidencias
	 */
	
	public static function enviarNotificacionIncidencia($idIncidencia, $idComercio)
	{
		$incidencia = IncidenciasModel::obtenerIncidencia($idIncidencia, $idComercio);
		$usuarios = IncidenciasModel::obtenerUsuariosIncidencia($idIncidencia);
		
		// $liga = "https://www.itravel.mx/new/solicitudes/dinamica/" . $idSolicitud;
		
		$html = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>itravel</title>
					</head>
						<style type="text/css">x
							body {margin: 0; padding: 0; min-width: 100%;  font-size: 15px; line-height: normal; color: #989ca1;}
							table{width: 100%; max-width: 600px;}
							.content, .info, .header{padding: 10px 30px;}
							.top, .contacto{padding: 20px 20px; color: #FFF;}
							p{font-size: 15px; margin-bottom: 5px;}
							h2, h3{margin: 0; padding: 0;}
							a{text-decoration: none;}
						</style>
						<body yahoo bgcolor="#f8f8fb" style="font-family: Arial, Sans-serif;">
							<table width="600" bgcolor="#f8f8fb" border="0" cellpadding="0" cellspacing="0" align="center">
								<tr>
									<td>
										<table width="100%"  class="header" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><img src="https://www.itravel.mx/img/logo-dark.png" width="160" /></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#FFF">
											<tr>
												<td width="100%">
													<p>&iexcl;Hola ' . $tarea->asesor . '! el asesor <strong>' . $tarea->asesorSecundario . '</strong> te ha asignado la siguiente tarea <strong>' . Text::title($tarea->tarea) . '</strong>.</p>
												</td>
											</tr>
											<tr>
												<td width="100%" style="text-align: center;">
													<br />
													<p><i>' . $tarea->descripcion . '</i></p>
													<br />
													<br />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="10" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><small><i>Notificación automática favor de no responder a este correo</i></small></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</body>
					</html>';
	
		$mailSent = false;
			
		$mail = new Mail;
		// $mailSent = $mail->sendMail("amf@3doubleu.com", "no-responder@itravel.mx","itravel 💬", "Tarea " . Text::title($tarea->tipo) . " (" . $tarea->inicialesSecundario .")", $html, $attachment);
		
		$mailSent = $mail->sendMail($tarea->correoAsesor, "no-responder@itravel.mx", "itravel 💬", "Tarea " . Text::title($tarea->tipo) . " (" . $tarea->inicialesSecundario .")", $html, $attachment);
		
		if ($mailSent) {
			return array("success" => true);
		} else {
			return array("success" => false, "error" => $mail->getError());
		}
	}
	
	public static function enviarNotificacionResultadoTarea($idTarea)
	{
		$tarea = TareasModel::obtenerTarea($idTarea);
		
		// $liga = "https://www.itravel.mx/new/solicitudes/dinamica/" . $idSolicitud;
		
		$html = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>itravel</title>
					</head>
						<style type="text/css">x
							body {margin: 0; padding: 0; min-width: 100%;  font-size: 15px; line-height: normal; color: #989ca1;}
							table{width: 100%; max-width: 600px;}
							.content, .info, .header{padding: 10px 30px;}
							.top, .contacto{padding: 20px 20px; color: #FFF;}
							p{font-size: 15px; margin-bottom: 5px;}
							h2, h3{margin: 0; padding: 0;}
							a{text-decoration: none;}
						</style>
						<body yahoo bgcolor="#f8f8fb" style="font-family: Arial, Sans-serif;">
							<table width="600" bgcolor="#f8f8fb" border="0" cellpadding="0" cellspacing="0" align="center">
								<tr>
									<td>
										<table width="100%"  class="header" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><img src="https://www.itravel.mx/img/logo-dark.png" width="160" /></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="20" cellspacing="0" border="0" bgcolor="#FFF">
											<tr>
												<td width="100%">
													<p>&iexcl;Hola ' . $tarea->asesorSecundario . '! el asesor <strong>' . $tarea->asesor . '</strong> ha respondido/resuelto la siguiente tarea <strong>' . Text::title($tarea->tarea) . '</strong>.</p>
												</td>
											</tr>
											<tr>
												<td width="100%" style="text-align: center;">
													<br />
													<p><i>' . $tarea->resultado . '</i></p>
													<br />
													<br />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" class="content" align="center" cellpadding="10" cellspacing="0" border="0" bgcolor="#f8f8fb">
											<tr>
												<td width="100%">
													<center><small><i>Notificación automática favor de no responder a este correo</i></small></center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</body>
					</html>';
	
		$mailSent = false;
			
		$mail = new Mail;
		// $mailSent = $mail->sendMail("amf@3doubleu.com", "no-responder@itravel.mx","itravel ✅", "Respuesta Tarea " . Text::title($tarea->tipo) . "  (" . $tarea->inicialesSecundario .")", $html, $attachment);
		
		$mailSent = $mail->sendMail($tarea->correoSecundario, "no-responder@itravel.mx", "itravel ✅", "Respuesta Tarea " . Text::title($tarea->tipo) . " (" . $tarea->inicialesAsesor .")", $html, $attachment);
		
		if ($mailSent) {
			return array("success" => true);
		} else {
			return array("success" => false, "error" => $mail->getError());
		}
	}
}
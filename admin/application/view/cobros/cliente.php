<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
<head>
    <title>Viabo Pay</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="author" content="3doubleu" />
	
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/dropzone/dist/dropzone.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/slick-carousel/slick/slick.css" rel="stylesheet" />
	<link href="<?php echo Config::get('URL'); ?>bower_components/zabuto-calendar/zabuto_calendar.min.css" rel="stylesheet" />
	
    <link href="<?php echo Config::get('URL'); ?>css/main.css?<?php echo time(); ?>" rel="stylesheet" />	
</head>
<body class="" data-topbar="dark" oncontextmenu="return false;">
	<section id="pago">
		<div class="container">
			<div class="row" style="max-width: 1200px; margin: 0 auto;">
				<div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
					<?php
						$color = "warning";
					
						if ($this->cobro->estatus == "Pendiente") $color = "warning";
						else if ($this->cobro->estatus == "Completado") $color = "success";
						else if ($this->cobro->estatus == "Cancelado") $color = "danger";
					?>
					<div class="text-center pt-5">
						<img src="<?php echo Config::get('URL'); ?>img/logo-big.png" width="150" />
					</div>
					
					<div id="detalle" class="border rounded mt-5 pt-5 pb-5 text-center bg-white">
						<h6 class="badge badge-pill badge-<?php echo $color; ?> text-center" id="lblEstatus"><?php echo $this->cobro->estatus; ?></h6>
						<h2 class="amount text-center pt-4 pr-4 pl-4 pb-2 mb-0"><span>$</span><?php echo number_format($this->cobro->monto+$this->cobro->comision, 2, ".", ","); ?> <span><small>MXN</small></span></h2>
					<?php
						if ($this->cobro->cargo > 0) {	
					?>
						<p class="text-muted"><small>(Incluye $<?php echo number_format($this->cobro->comision, 2, ".", ","); ?>  de cargo por servicio del <?php echo number_format($this->cobro->cargo, 1, ".", ","); ?>%)</small></p>
						
					<?php
						}
					?>
						<h5 class="mb-4"><i class="os-icon os-icon-user"></i> <?php echo Text::title($this->cobro->nombreCompleto); ?></h5>
						<h6><a href="javascript: showItem('mensaje');" class="">Ver detalles del pago</a></h6>
						<div id="mensaje" style="display: none;">
							<p class="mt-3"><i><?php echo $this->cobro->mensaje; ?></i></p>
						</div>
					</div>
				
					<div id="formulario" <?php if ($this->cobro->estatus != "Pendiente") { ?> style="display: none;" <?php } ?> class="mb-5">
						<form name="realizarCobro" id="realizarCobro" novalidate class="needs-validation" method="post">
							
							<h5 class="mt-4 mb-3">Forma de pago
								<svg class="icon icon--full-color ml-2" viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-master"><title id="pi-master">Mastercard</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"/><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"/><circle fill="#EB001B" cx="15" cy="12" r="7"/><circle fill="#F79E1B" cx="23" cy="12" r="7"/><path fill="#FF5F00" d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"/></svg>
								<svg class="icon icon--full-color ml-1" viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-visa"><title id="pi-visa">Visa</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"/><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"/><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z" fill="#142688"/></svg>
							</h5>

							<div class="row">
								<div class="col-12 col-md-12 mt-2">
									<div class="form-floating mb-3">
										<label for="numeroTarjeta">Numero tarjeta *</label>
										<input type="text" name="numeroTarjeta" id="numeroTarjeta" class="form-control" placeholder="" maxlength="16" autocomplete="off" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-4 col-md-4">
											<div class="form-floating mb-3">
												<label for="mes">Mes *</label>
												<input type="text" name="mes" id="mes" class="form-control" placeholder="MM" maxlength="2" autocomplete="off" required>
											</div>
										</div>
										<div class="col-4 col-md-4">
											<div class="form-floating mb-3">
												<label for="ano">Año *</label>
												<input type="text" name="ano" id="ano" class="form-control" placeholder="AA" maxlength="2" autocomplete="off" required>
											</div>
										</div>
										<div class="col-4 col-md-4">
											<div class="form-floating mb-3">
												<label for="cvv">CVV</label>
												<input type="text" name="cvv" id="cvv" class="form-control" placeholder="CVV" maxlength="3" autocomplete="off" required>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-floating mb-3">
										<label for="tarjetahabiente">Tarjetahabiente *</label>
										<input type="text" name="tarjetahabiente" id="tarjetahabiente" class="form-control" placeholder="" autocomplete="off" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-floating mb-3">
										<label for="correo">Correo electrónico *</label>
										<input type="email" name="correo" id="correo" class="form-control" placeholder="" value="<?php echo $this->cobro->correo; ?>" autocomplete="off" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-floating mb-3">
										<label for="telefono">Teléfono *</label>
										<input type="text" name="telefono" id="telefono" class="form-control" placeholder="" value="<?php echo $this->cobro->telefono; ?>" maxlength="10" autocomplete="off" required>
									</div>
								</div>
							</div>
							<p class="text-muted pt-2 pb-2">Al hacer clic en el botón de <strong>Pagar</strong>, accedo a los <a href="https://www.viabo.com/terminos" target="_blank">Términos y Condiciones</a> y <a href="https://www.viabo.com/privacidad" target="_blank">Aviso de Privacidad</a>.</p>
							<div class="form-group">
								<input type="hidden" name="monto" id="monto" value="<?php echo $this->cobro->monto; ?>" />
								<input type="hidden" name="comision" id="comision" value="<?php echo $this->cobro->comision; ?>" />
								<input type="hidden" name="idTerminal" id="idTerminal" value="<?php echo $this->cobro->idTerminal; ?>" />
								<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->cobro->idComercio; ?>" />
								<input type="hidden" name="idCobro" id="idCobro" value="<?php echo $this->idCobro; ?>" />
								<input type="hidden" name="codigoVerificacion" id="codigoVerificacion" value="<?php echo $this->codigoVerificacion; ?>" />
								<button name="btn-pagar" id="btn-pagar" class="btn btn-primary btn-block btn-md">
									<i class="os-icon os-icon-lock"></i>
									<span>Pagar</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="https://www.itravel.mx/new/assets/libs/jquery/jquery.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/jquery/jquery-ui.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/jquery.number/jquery.number.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/simplebar/simplebar.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/node-waves/waves.min.js"></script>
	
	
	<script src="https://www.itravel.mx/new/assets/libs/dropzone/min/dropzone.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/select2/js/select2.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/parsleyjs/parsley.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/libs/toastr/build/toastr.min.js"></script>
	<script src="https://www.itravel.mx/new/assets/js/pages/form-validation.init.js"></script>
	
	
	<script type="text/javascript">
		
		var url = '<?php echo Config::get('URL'); ?>';
		
		$(document).ready(function() {
			$("#numeroTarjeta, #mes, #ano, #cvv, #telefono").keydown(function (e) {
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
					return;
				}

				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
			
			$("#realizarCobro").on("submit", (function(e) {

				e.preventDefault();
				
				$('#btn-pagar').prop('disabled', true);

				var form = document.getElementById('realizarCobro');

				if (form.checkValidity() === false) {
					e.stopPropagation();
					$('#btn-pagar').prop('disabled', false);
				} else {
					form.classList.add('was-validated');

					var formData = new FormData(this);

					$.ajax({
						url: url + "cobros/realizarCobro",
						type: "POST",
						dataType: "JSON",
						data:  formData,
						contentType: false,
						cache: false,
						processData: false,
						success: function(result)
						{
							if (result.success) {
								$('#realizarCobro')[0].reset();
								form.classList.remove('was-validated');
								
								$('#lblEstatus').removeClass("text-warning");
								$('#lblEstatus').addClass("text-success");
								$('#lblEstatus').html("Completado");
								$('#formulario').hide();
								
								var bienvenidaModal = new bootstrap.Modal(document.getElementById('pagoAprobado'), { keyboard: true });
								bienvenidaModal.show();
							} else {
								var bienvenidaModal = new bootstrap.Modal(document.getElementById('pagoRechazado'), { keyboard: true });
								bienvenidaModal.show();
								$('#btn-pagar').prop('disabled', false);
							}

						},
						error: function(e) 
						{
							$toast = toastr["error"](e);
						}          
					});
				}

			}));
		});
		
	</script>
	
	<div class="modal fade" id="pagoRechazado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<form name="validarCliente" novalidate method="post" action="<?php echo Config::get('URL');; ?>clientes/validarTelefonoCliente" class="needs-validation form form-horizontal">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Pago Rechazado</h5>
					</div>
					<div class="modal-body p-3 p-md-5">
						<div class="mb-4 text-center">
							<i class="os-icon os-icon-x-circle text-danger bx-lg mt-5 mb-5" style="font-size: 12em !important;"></i>
							<p class="text-danger">Pago rechazado favor de intentar de nuevo.</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="pagoAprobado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<form name="validarCliente" novalidate method="post" action="<?php echo Config::get('URL');; ?>clientes/validarTelefonoCliente" class="needs-validation form form-horizontal">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Pago Aprobado</h5>
					</div>
					<div class="modal-body p-3 p-md-5">
						<div class="mb-4 text-center">
							<i class="os-icon os-icon-ui-21 text-success bx-lg mt-5 mb-5" style="font-size: 12em !important;"></i>
							<p class="text-success">Pago aprobado con éxito.</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="https://www.itravel.mx/new/assets/js/app.js?<?php echo time(); ?>"></script>
    </body>
</html>
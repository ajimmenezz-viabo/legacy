<form name="conciliarTransacciones" id="conciliarTransacciones" novalidate method="post">
	<div class="content-i">
		<div class="content-box">
			<div class="row">
				<div class="col-lg-12">
					<h5 class="mb-3">
						Conciliaciones
						<a href="#">
							<small class="float-right">Historial conciliaciones</small>
						</a>	
					</h5>
				</div>
			</div>
			<div style="width: 100% !important; position: sticky !important; top: 0; z-index: 999;">
				<div class="row">
					<div class="col-lg-12">
						<div class="element-box">
							<div class="row">
								<div class="col-lg-5 text-center">
									<h2 id="lblTotalTransaccionesTerminal" class="text-muted">$0.00 <small>MXN</small></h2>
									<a href="#" id="verDesgloseTransaccionesTerminal" class="text-muted">Ver Desglose</a>
									<input type="hidden" name="totalTransaccionesTerminal" id="totalTransaccionesTerminal" value="0.00" />
								</div>
								<div class="col-lg-2 text-center">
									<!--<button class="btn btn-primary mt-2" id="btn-conciliar"><i class="os-icon os-icon-minimize-2" style="font-size: 30px;"></i></button>-->
									<a class="btn btn-primary mt-2 ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>conciliaciones/confirmarPrevioConciliaciones" id="btn-conciliar"><i class="os-icon os-icon-minimize-2" style="font-size: 30px;"></i></a>
								</div>
								<div class="col-lg-5 text-center">
									<h2 id="lblTotalTransaccionesCuenta" class="text-muted">$0.00 <small>MXN</small></h2>
									<a href="#" id="verDesgloseTransaccionesCuenta" class="text-muted">Ver Desglose</a>
									<input type="hidden" name="totalTransaccionesCuenta" id="totalTransaccionesCuenta" value="0" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="element-wrapper">
						<div class="element-box" id="transacciones">
							<h5 class="form-header">
								Transacciones <a href="<?php echo Config::get('URL'); ?>sincronizaciones/sincronizarTransaccionesTerminales"><i class="os-icon os-icon-refresh-cw ml-2" style="width: 27px;"></i></a> 
							</h5>
							<table class="table table-striped">
								<thead>
									<th></th>
									<th>Fecha</th>
									<th>Marca</th>
									<th>Importe</th>
									<th>Liquidado</th>
									<th></th>
								</thead>
								<tbody>
								<?php
									$totalImporte = 0;
									$totalRecibido = 0;

									$tipos = array("0" => "Crédito", "1" => "Débito", "2" => "Cargos");

									if ($this->transaccionesTerminal) {
										foreach ($this->transaccionesTerminal as $transaccion) {

											if ($transaccion->aprobada == 1 && $transaccion->reversada == 0) {

												$color = "";
												$estatus = "";

												if ($transaccion->reversada) {
													$color = "warning";
													$estatus = "Reversada";
												} elseif ($transaccion->aprobada) {
													$color = "success";
													$estatus = "Aprobada";
												} elseif (!($transaccion->aprobada)) {
													$color = "danger";
													$estatus = "No Aprobada";
												} else {
													$color = "warning";
													$estatus = "Pendiente";
												}

												if (($transaccion->marca == "VISA" || $transaccion->marca == "MASTER CARD") && $transaccion->tipo == "0") {
													$comision = 0.03; // 0.03 - 0.0178
												} elseif (($transaccion->marca == "VISA" || $transaccion->marca == "MASTER CARD") && $transaccion->tipo == "1") {
													$comision = 0.025; // 0.03 - 0.014
												} elseif ($transaccion->marca == "AMEX") {
													$comision = 0.035; // 0.035 - 0.027
												} else $comosion = 0;

								?>
									<tr id="transaccionTerminal<?php echo $transaccion->idTransaccion; ?>">
										<td style="vertical-align: top !important;">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="idTransaccionesTerminal[]" id="idTransaccionTerminal<?php echo $transaccion->idTransaccion; ?>" value="<?php echo $transaccion->idTransaccion; ?>" onClick="javascript: agregarTransaccionesTerminal(<?php echo $transaccion->idTransaccion; ?>);" />
											</div>
										</td>
										<td nowrap><?php echo substr($transaccion->fecha, 0, 10); ?></td>
										<td>
											<?php 
												
												if ($transaccion->marca == "VISA") {
											?>
												<svg class="icon icon--full-color" viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-visa"><title id="pi-visa">Visa</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"/><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"/><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z" fill="#142688"/></svg>
											<?php
												} elseif ($transaccion->marca == "MASTER CARD") {
											?>
												<svg class="icon icon--full-color" viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-master"><title id="pi-master">Mastercard</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"/><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"/><circle fill="#EB001B" cx="15" cy="12" r="7"/><circle fill="#F79E1B" cx="23" cy="12" r="7"/><path fill="#FF5F00" d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"/></svg>
											<?php
												} elseif ($transaccion->marca == "AMEX") {
											?>
												<svg class="icon icon--full-color" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 38 24" width="38" height="24" aria-labelledby="pi-american_express"><title id="pi-american_express">American Express</title><g fill="none"><path fill="#000" d="M35,0 L3,0 C1.3,0 0,1.3 0,3 L0,21 C0,22.7 1.4,24 3,24 L35,24 C36.7,24 38,22.7 38,21 L38,3 C38,1.3 36.6,0 35,0 Z" opacity=".07"/><path fill="#006FCF" d="M35,1 C36.1,1 37,1.9 37,3 L37,21 C37,22.1 36.1,23 35,23 L3,23 C1.9,23 1,22.1 1,21 L1,3 C1,1.9 1.9,1 3,1 L35,1"/><path fill="#FFF" d="M8.971,10.268 L9.745,12.144 L8.203,12.144 L8.971,10.268 Z M25.046,10.346 L22.069,10.346 L22.069,11.173 L24.998,11.173 L24.998,12.412 L22.075,12.412 L22.075,13.334 L25.052,13.334 L25.052,14.073 L27.129,11.828 L25.052,9.488 L25.046,10.346 L25.046,10.346 Z M10.983,8.006 L14.978,8.006 L15.865,9.941 L16.687,8 L27.057,8 L28.135,9.19 L29.25,8 L34.013,8 L30.494,11.852 L33.977,15.68 L29.143,15.68 L28.065,14.49 L26.94,15.68 L10.03,15.68 L9.536,14.49 L8.406,14.49 L7.911,15.68 L4,15.68 L7.286,8 L10.716,8 L10.983,8.006 Z M19.646,9.084 L17.407,9.084 L15.907,12.62 L14.282,9.084 L12.06,9.084 L12.06,13.894 L10,9.084 L8.007,9.084 L5.625,14.596 L7.18,14.596 L7.674,13.406 L10.27,13.406 L10.764,14.596 L13.484,14.596 L13.484,10.661 L15.235,14.602 L16.425,14.602 L18.165,10.673 L18.165,14.603 L19.623,14.603 L19.647,9.083 L19.646,9.084 Z M28.986,11.852 L31.517,9.084 L29.695,9.084 L28.094,10.81 L26.546,9.084 L20.652,9.084 L20.652,14.602 L26.462,14.602 L28.076,12.864 L29.624,14.602 L31.499,14.602 L28.987,11.852 L28.986,11.852 Z"/></g></svg>
											<?php
												} elseif ($transaccion->marca == "CARNET") {
											?>
												<svg id="Layer_2" xmlns="http://www.w3.org/2000/svg" width="38" height="24" viewBox="0 0 169.1187 123.709"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:#ed1c24;}</style></defs><g id="Layer_1-2"><rect class="cls-2" width="169.1187" height="123.709"/><path class="cls-1" d="M83.3614,46.6377c25.146,0,45.9799,9.6128,50.1489,22.2402,.4922-1.501,.8066-3.043,.8066-4.623,0-14.8384-22.8115-26.8662-50.9555-26.8662s-50.9556,12.0278-50.9556,26.8662c0,1.58,.3096,3.122,.8047,4.623,4.166-12.6274,25.0058-22.2402,50.1509-22.2402Zm0-15.9849c25.146,0,45.9799,9.6113,50.1489,22.2388,.4922-1.5054,.8066-3.0449,.8066-4.6255,0-14.8374-22.8115-26.8652-50.9555-26.8652s-50.9556,12.0278-50.9556,26.8652c0,1.5806,.3096,3.1201,.8047,4.6255,4.166-12.6275,25.0058-22.2388,50.1509-22.2388Zm20.934,64.3179l-10.4707-13.3291h-4.9814v19.874h4.7529v-13.041l10.3174,13.041h5.1348v-19.874h-4.753v13.3291Zm-78.3828,2.4385c-.98,.6806-2.1533,1.0195-3.5146,1.0195-1.8491,0-3.3506-.5352-4.5025-1.6006-1.1572-1.0664-1.7329-2.8584-1.7329-5.3721,0-2.3701,.5865-4.0849,1.7544-5.1425,1.1709-1.0577,2.6939-1.5879,4.5752-1.5879,1.356,0,2.5132,.2988,3.4658,.8965,.9473,.5976,1.5772,1.4101,1.876,2.4384l5.086-.9423c-.5787-1.5928-1.4454-2.8096-2.6021-3.6602-1.938-1.4316-4.4648-2.1494-7.5728-2.1494-3.5576,0-6.4316,.915-8.6171,2.7422-2.1851,1.83-3.2749,4.3974-3.2749,7.7011,0,3.128,1.0874,5.5899,3.2617,7.3926,2.1743,1.8008,4.9487,2.7051,8.3232,2.7051,2.7315,0,4.9839-.5332,6.7573-1.5938,1.7764-1.0546,3.044-2.6748,3.8082-4.8544l-4.9732-1.1973c-.4277,1.456-1.1328,2.5264-2.1177,3.2051Zm110.541-15.7676v3.3613h7.5596v16.5127h5.1426v-16.5127h7.5029v-3.3613h-20.2051Zm-16.7783,11.1172h12.7559v-3.3633h-12.7559v-4.3926h13.7002v-3.3613h-18.8428v19.874h19.3428v-3.3642h-14.2002v-5.3926Zm-39.6723,1.6631c-.7212-.6055-1.6363-1.1602-2.7422-1.6661,2.2285-.2529,3.9048-.8632,5.0268-1.8378,1.1226-.9717,1.6797-2.2061,1.6797-3.6973,0-1.1787-.3716-2.2227-1.1118-3.1348-.7397-.9131-1.7246-1.5508-2.96-1.9082-1.2324-.3584-3.205-.5361-5.9287-.5361h-10.8154v19.874h5.1431v-8.2832h1.0439c1.1812,0,2.0425,.0723,2.5889,.2207,.5464,.1485,1.06,.4229,1.5498,.8233,.4844,.3984,1.3887,1.3671,2.7129,2.9013l3.6894,4.3379h6.1465l-3.1084-3.8701c-1.2217-1.5439-2.1933-2.6211-2.9145-3.2236Zm-7.9117-4.3594h-3.7968v-5.0596h4.0039c2.0776,0,3.3291,.0244,3.7461,.0703,.8291,.1075,1.4721,.3682,1.9321,.7803,.4551,.4141,.6836,.9551,.6836,1.625,0,.5977-.1748,1.0986-.522,1.4971-.3447,.3974-.8232,.6777-1.437,.8418-.6138,.164-2.1504,.2451-4.6099,.2451Zm-27.3359-8.4209l-9.9058,19.874h5.4522l2.1069-4.5049h10.1778l2.2148,4.5049h5.5894l-10.1807-19.874h-5.4546Zm-.7778,12.0049l3.4472-7.3623,3.5039,7.3623h-6.9511Z"/></g></svg>
											<?php	
												} else {
													echo $transaccion->marca;
													
												}
											?>
										</td>
										<td class="text-right">$<?php echo number_format($transaccion->monto, 2, ".", ","); ?></td>
										<td class="text-right">
										<?php
											if ($estatus == "Aprobada") {	
										?>
											$<?php echo number_format($transaccion->monto-($transaccion->monto*$comision*1.16), 2, ".", ","); ?>
											<input type="hidden" name="liquidado<?php echo $transaccion->idTransaccion; ?>" id="liquidado<?php echo $transaccion->idTransaccion; ?>" value="<?php echo number_format($transaccion->monto-($transaccion->monto*$comision*1.16), 2, ".", ""); ?>" />
										<?php
											}
										?>
										</td>
										<td></td>
									</tr>
								<?php
											}	
										}
									}	
								?>
									</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="element-wrapper">
						<div class="element-box" id="ingresosCuenta" style="border: 2px solid #caff00;">
							<h5 class="form-header">
								Cuenta bancaria <?php if ($this->idComercio == "1683") { ?>
								<a href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>paybook/autentificacion2Factores" class="ld-accion-rapida-right right-bar-toggle"><i class="os-icon os-icon-refresh-cw ml-2" style="width: 27px;"></i></a> 
								<img src="<?php echo Config::get('URL'); ?>img/bancos/afirme.png" height="26" class="float-end float-right" /><?php } ?>
							</h5>
							<table class="table table-striped">
								<thead>
									<th></th>
									<th>Fecha</th>
									<th>Concepto</th>
									<th>Referencia</th>
									<th>Abono</th>
								</thead>
								<tbody>
								<?php
									$totalImporte = 0;
									$totalRecibido = 0;

									$tipos = array("credit" => "Crédito", "debit" => "Débito", "charge_card" => "Cargos");

									if ($this->transaccionesCuenta) {
										foreach ($this->transaccionesCuenta as $transaccion) {

								?>
									<tr id="transaccionCuenta<?php echo $transaccion->idTransaccion; ?>">
										<td class="text-center" style="vertical-align: middle!important;">
											<div class="form-check" style="margin-top: -12px;">
												<input class="form-check-input" type="checkbox" name="idTransaccionCuenta" id="idTransaccionCuenta<?php echo $transaccion->idTransaccion; ?>" value="<?php echo $transaccion->idTransaccion; ?>" onClick="javascript: agregarTransaccionesCuenta('<?php echo $transaccion->idTransaccion; ?>');" />
											</div>
										</td>
										<td nowrap><?php echo substr($transaccion->fecha, 0, 10); ?></td>
										<td style="line-height: 12px !important;"><small><?php echo $transaccion->concepto; ?></small></td>
										<td><?php echo $transaccion->referencia; ?></td>
										<td class="text-right">
											$<?php echo number_format($transaccion->monto, 2, ".", ","); ?>
											<input type="hidden" name="abono<?php echo $transaccion->idTransaccion; ?>" id="abono<?php echo $transaccion->idTransaccion; ?>" value="<?php echo number_format($transaccion->monto, 2, ".", ""); ?>" />
										</td>
										<td></td>
									</tr>
								<?php
										}	
									} else {
								?>
									<tr>
										<td colspan="5">
											<div class="row">
												<div class="col-md-4 offset-md-4 pt-5 mb-5">
													<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-refresh-cw"></i><span>Sincronizar cuenta</span></button>
												</div>
											</div>
										</td>
									</tr>
								<?php	
									}	
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">

	function agregarTransaccionesTerminal(idTransaccionTerminal){
			
		var totalTransaccionesTerminal = $('#totalTransaccionesTerminal').val();
		var totalTransaccionesCuenta = $('#totalTransaccionesCuenta').val();
		var liquidado = $('#liquidado' + idTransaccionTerminal).val();
		
		if ($('#idTransaccionTerminal' + idTransaccionTerminal).prop("checked") == true) {
			totalTransaccionesTerminal = parseFloat(totalTransaccionesTerminal) + parseFloat(liquidado);
		} else {
			totalTransaccionesTerminal = parseFloat(totalTransaccionesTerminal) - parseFloat(liquidado);
		}
		
		$('#lblTotalTransaccionesTerminal').html('$' + $.number(totalTransaccionesTerminal, 2) + ' <small>MXN</small>');
		$('#totalTransaccionesTerminal').val(parseFloat(totalTransaccionesTerminal));
		
		if ($.number(totalTransaccionesTerminal, 2) == $.number(totalTransaccionesCuenta, 2)) {
			$('#btn-conciliar').removeClass('btn-primary')
			$('#btn-conciliar').addClass('btn-success');
		} else {
			$('#btn-conciliar').removeClass('btn-success')
			$('#btn-conciliar').addClass('btn-primary');
		}
		
	}
	
	function agregarTransaccionesCuenta(idTransaccionCuenta){
		
		var totalTransaccionesTerminal = $('#totalTransaccionesTerminal').val();
		var totalTransaccionesCuenta = $('#totalTransaccionesCuenta').val();
		var abono = $('#abono' + idTransaccionCuenta).val();
		
		if ($('#idTransaccionCuenta' + idTransaccionCuenta).prop("checked") == true) {
			totalTransaccionesCuenta = parseFloat(totalTransaccionesCuenta) + parseFloat(abono);
		} else {
			totalTransaccionesCuenta = parseFloat(totalTransaccionesCuenta) - parseFloat(abono);
		}
		
		$('#lblTotalTransaccionesCuenta').html('$' + $.number(totalTransaccionesCuenta, 2) + ' <small>MXN</small>');
		$('#totalTransaccionesCuenta').val(parseFloat(totalTransaccionesCuenta));
		
		if ($.number(totalTransaccionesTerminal, 2) == $.number(totalTransaccionesCuenta, 2)) {
			$('#btn-conciliar').removeClass('btn-primary')
			$('#btn-conciliar').addClass('btn-success');
		} else {
			$('#btn-conciliar').removeClass('btn-success')
			$('#btn-conciliar').addClass('btn-primary');
		}
	}
			
</script>
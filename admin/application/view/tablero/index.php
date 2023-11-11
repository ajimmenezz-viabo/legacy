	<div class="content-box">
		<div class="os-tabs-w">
			<div class="os-tabs-controls os-tabs-complex">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="<?php echo Config::get('URL'); ?>tablero">
							<img src="<?php echo Config::get('URL'); ?>img/icono-pay.png"  height="24" class="m-1 mr-2" /> <span class="tab-label">Viabo Pay</span>
						</a>
					</li>
				<?php
					if ($this->idComercio == 1683) {
				?>
					<li class="nav-item">
						<a class="nav-link " href="<?php echo Config::get('URL'); ?>tablero/tarjetas">
							<img src="<?php echo Config::get('URL'); ?>img/icono-card.png" height="32" class="mr-2" /> <span class="tab-label">Viabo Card</span>
						</a>
					</li>
				<?php
					}
				?>			
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-4 col-xxl-3">
				<div class="element-balances justify-content-between mobile-full-width">
					<div class="balance balance-v2">
						<div class="balance-title">
							Saldo disponible
						</div>
						<div class="balance-value">
							<span class="d-xxl-none"><?php if ($this->idComercio == 1683) echo "$2,757,260.13"; else echo "$0.00"; ?></span><span class="d-none d-xxl-inline-block"><?php if ($this->idComercio == 1683) echo "$2,757,260.13"; else echo "$0.00"; ?></span>
						</div>
					</div>
				</div>
				<div class="balance-table mb-4">
					<table class="table table-lightborder table-bordered table-v-compact mb-0">
						<tr>
							<td class="col-6">
								<strong><?php if ($this->idComercio == 1683) echo "$2,719,976.13"; else echo "$0.00"; ?></strong>
								<div class="balance-label smaller lighter text-nowrap">
									Liquidado
								</div>
							</td>
							<td class="col-6">
								<a href="#">
									<strong><?php if ($this->idComercio == 1683) echo "$37,284.00"; else echo "$0.00"; ?></strong>
									<div class="balance-label smaller lighter text-nowrap">
										En Tránsito
									</div>
								</a>
							</td>
						<!--
							<td class="d-sm-none d-xxxxl-table-cell d-md-table-cell d-xxl-none">
								<strong>$0.00</strong>
								<div class="balance-label smaller lighter text-nowrap">
									Pendiente
								</div>
							</td>
						-->
						</tr>

					</table>
				</div>
				<div class="element-wrapper pb-4 mb-4 border-bottom">
					<div class="element-box-tp">
						<a class="btn btn-primary" href="<?php echo Config::get('URL'); ?>conciliaciones"><i class="os-icon os-icon-minimize-2"></i><span>Conciliación liquidaciones</span></a>
					</div>
				</div>
				<?php
                    //var_dump($this->transacciones);
					$totalIngresos = 0;
					$totalEgresos = 0;
					$comision = 0;

					if ($this->transacciones["items"]) {
						foreach ($this->transacciones["items"] as $transaccion) {

							if ($transaccion->approved && $transaccion->reversed == 0) {

								if (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "0") {
									$comision = 0.0178;
								}elseif (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "1") {
									$comision = 0.014;
								}elseif ($transaccion->card_brand == "AMEX") {
									$comision = 0.027;
								}

								$totalIngresos+= $transaccion->amount;
								$totalEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);
							}
						}
					}
				?>
				<div class="row pt-5">
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Ingresos
							</div>
							<div class="value">
								$<span id="lblTotalIngresos"><?php echo number_format($totalIngresos, 2, ".", ","); ?></span>
							</div>
						</a>
					</div>
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Egresos
							</div>
							<div class="value text-danger">
								$<span id="lblTotalEgresos"><?php echo number_format($totalEgresos, 2, ".", ","); ?></span>
							</div>
						</a>
					</div>
				</div>

			</div>

			<div class="col-sm-12 col-lg-6 col-xxl-6 ml-2">
				 <div class="element-wrapper compact pt-4">
					<div class="element-actions d-none d-sm-block">
					<?php
						if ($this->comercio->idTerminal != "") {	
					?>
						<a class="btn btn-primary btn-sm ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>cobros/nuevoCobro/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-link"></i><span>Liga Pago</span></a>
						<a class="btn btn-success btn-sm ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>cobros/terminarVirtual/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-grid-circles"></i><span>Terminal Virtual</span></a>
					<?php
						}
					?>
					</div>
					<h6 class="element-header">
						Solicitar Pago
					</h6>
					<div class="element-box-tp mt-5">
						<div class="inline-profile-tiles">
							<div class="row">
								<div class="col-4 col-sm-3 col-xxl-3">
									<div class="profile-tile profile-tile-inlined">
										<a class="profile-tile-box faded" href="#">
											<div class="pt-new-icon">
												<i class="os-icon os-icon-at-sign"></i>
											</div>
											<div class="pt-user-name">
												Crear<br />
												Comunicación
											</div>
										</a>
									</div>
								</div>
								<div class="col-4 col-sm-3 col-xxl-3">
									<div class="profile-tile profile-tile-inlined">
										<a class="profile-tile-box" href="<?php echo Config::get('URL'); ?>transacciones">
											<div class="pt-new-icon">
												<i class="os-icon os-icon-check"></i>
											</div>
											<div class="pt-user-name">
												Pendiente<br />
												Liquidación
											</div>
										</a>
									</div>
								</div>
								<div class="col-4 col-sm-3 col-xxl-3">
									<div class="profile-tile profile-tile-inlined">
										<a class="profile-tile-box" href="<?php echo Config::get('URL'); ?>incidencias">
											<div class="pt-new-icon">
												<i class="os-icon os-icon-flag"></i>
											</div>
											<div class="pt-user-name">
												Listado<br />
												Incidencias
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="element-wrapper compact pt-4" id="tablero-dinamico">
					<div class="element-actions">
						<form class="form-inline justify-content-sm-end">
							<label class="smaller" for="">Filtrar Por</label>
							<select name="dias" id="dias" class="form-control form-control-sm form-control-faded" onchange="javascript: filtrarUltimasTransacciones();">
								<option value="0" selected>Mes actual</option>
								<option value="7">Últimos 7 días</option>
								<option value="15">Últimos 15 días</option>
								<option value="30">Últimos 30 días</option>
							</select>
						</form>
						<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
					</div>
					<div id="transacciones-tablero">
						<h6 class="element-header mb-3">
							Últimas Transacciones <span id="lblUltimasTransacciones">- Mes actual</span>
						</h6>
						<div class="row">
							<div class="col-md-12 mb-2">
								<a href="javascript: filtrarLocal('transacciones-tablero', 'visa'); actualizarTotalesTablero('Visa');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>
								<a href="javascript: filtrarLocal('transacciones-tablero', 'master-card'); actualizarTotalesTablero('MasterCard');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>
								<a href="javascript: filtrarLocal('transacciones-tablero', 'amex'); actualizarTotalesTablero('Amex');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>
								
								<a href="javascript: filtrarLocal('transacciones-tablero', 'aprobada'); actualizarTotalesTablero('Aprobada');"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>
								<a href="javascript: filtrarLocal('transacciones-tablero', 'reversada'); actualizarTotalesTablero('Reversada');"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>
								<a href="javascript: filtrarLocal('transacciones-tablero', 'no-aprobada'); actualizarTotalesTablero('NoAprobada');"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>
								<a href="javascript: filtrarLocal('transacciones-tablero', 'contracargo'); actualizarTotalesTablero('Contracargo');"><span class="badge badge-pill badge-danger mr-1">Contracargo</span></a>
							</div>
						</div>
						<div class="element-box-tp" style="max-height: 650px; overflow-y: scroll;">
							<table class="table table-clean">
						<?php	

							$totalVisaEgresos = 0;
							$totalMasterCardEgresos = 0;
							$totalAmexEgresos = 0;
							$totalAprobadaEgresos = 0;
							$totalNoAprobadaEgresos = 0;
							$totalReversadaEgresos = 0;

							$totalVisaIngresos = 0;
							$totalMasterCardIngresos = 0;
							$totalAmexIngresos = 0;
							$totalAprobadaIngresos = 0;
							$totalNoAprobadaIngresos = 0;
							$totalReversadaIngresos = 0;

							$totalEgresos = 0;
							$totalIngresos = 0;

							if ($this->transacciones["items"]) {
								foreach ($this->transacciones["items"] as $transaccion) {

									$color = "";

									if ($transaccion->reversed) {
										$color = "warning";
										$estatus = "Reversada";
										$totalReversada = $transaccion->amount;
									} elseif ($transaccion->approved) {
										$color = "success";
										$estatus = "Aprobada";

										if (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "0") {
											$comision = 0.0178;
										} elseif (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "1") {
											$comision = 0.014;
										} elseif ($transaccion->card_brand == "AMEX") {
											$comision = 0.027;
										}

										$totalAprobadaIngresos += $transaccion->amount;
										$totalAprobadaEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);

										$totalIngresos += $transaccion->amount;
										$totalEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);

									} elseif (!($transaccion->approved)) {
										$color = "danger";
										$estatus = "No Aprobada";
										$totalNoAprobada = $transaccion->amount;
									} else {
										$color = "warning";
										$estatus = "";
									}

									 if ($transaccion->approved && $transaccion->reversed == 0) {
										 if ($transaccion->card_brand =="AMEX") {
											$totalAmexIngresos += $transaccion->amount;
											 $totalAmexEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);
										} elseif ($transaccion->card_brand == "VISA") {
											$totalVisaIngresos += $transaccion->amount;
											$totalVisaEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);
										} elseif ($transaccion->card_brand == "MASTER CARD") {
											$totalMasterCardIngresos += $transaccion->amount;
											$totalMasterCardEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);
										}
									 }

						?>
								<tr class="list-transacciones-tablero <?php echo str_replace(" ", "-", strtolower($transaccion->card_brand)); ?> <?php echo str_replace(" ", "-", strtolower($estatus)); ?>">
									<td>
										<div class="value">
											<?php echo $transaccion->card_brand; ?> - <?php echo $transaccion->card_number; ?>
										</div>
										<span class="sub-value"><span class="text-<?php echo $color; ?>"><?php if ($transaccion->reversed) echo "Reversada"; elseif ($transaccion->approved) echo "Aprobada"; else echo "No Aprobada"; ?></span></span>
									</td>
									<td class="text-right">
										<div class="value">
											<strong>$<?php echo number_format($transaccion->amount, 2, ".", ","); ?></strong>
										</div>
										<span class="sub-value"><?php echo substr($transaccion->transaction_date, 0, 10); ?> <?php echo substr($transaccion->transaction_date, 11, 5); ?></span>
									</td>
								</tr>
						<?php

								}	
							} else {
						?>
								<tr>
									<td colspan="2" class="text-center p-4">
										<i class="text-muted">No hay transacciones por mostrar</i>
									</td>
								</tr>	
						<?php

							}		
						?>
							</table>

						</div>
						<input type="hidden" name="totalVisaIngresos" id="totalVisaIngresos" value="<?php echo $totalVisaIngresos; ?>" />
						<input type="hidden" name="totalMasterCardIngresos" id="totalMasterCardIngresos" value="<?php echo $totalMasterCardIngresos; ?>" />
						<input type="hidden" name="totalAmexIngresos" id="totalAmexIngresos" value="<?php echo $totalAmexIngresos; ?>" />
						<input type="hidden" name="totalAprobadaIngresos" id="totalAprobadaIngresos" value="<?php echo $totalAprobadaIngresos; ?>" />
						<input type="hidden" name="totalNoAprobadaIngresos" id="totalNoAprobadaIngresos" value="<?php echo $totalNoAprobadaIngresos; ?>" />
						<input type="hidden" name="totalReversadaIngresos" id="totalReversadaIngresos" value="<?php echo $totalReversadaIngresos; ?>" />
						<input type="hidden" name="totalIngresos" id="totalIngresos" value="<?php echo $totalIngresos; ?>" />

						<input type="hidden" name="totalVisaEgresos" id="totalVisaEgresos" value="<?php echo $totalVisaEgresos; ?>" />
						<input type="hidden" name="totalMasterCardEgresos" id="totalMasterCardEgresos" value="<?php echo $totalMasterCardEgresos; ?>" />
						<input type="hidden" name="totalAmexEgresos" id="totalAmexEgresos" value="<?php echo $totalAmexEgresos; ?>" />
						<input type="hidden" name="totalAprobadaEgresos" id="totalAprobadaEgresos" value="<?php echo $totalAprobadaEgresos; ?>" />
						<input type="hidden" name="totalNoAprobadaEgresos" id="totalNoAprobadaEgresos" value="<?php echo $totalNoAprobadaEgresos; ?>" />
						<input type="hidden" name="totalReversadaEgresos" id="totalReversadaIngresos" value="<?php echo $totalReversadaEgresos; ?>" />
						<input type="hidden" name="totalEgresos" id="totalEgresos" value="<?php echo $totalEgresos; ?>" />

						<a class="centered-load-more-link" href="<?php echo Config::get('URL'); ?>transacciones"><span>Ver todas transacciones</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content-panel compact color-scheme-dark" style="display: none;">
		<div class="content-panel-close">
			<i class="os-icon os-icon-close"></i>
		</div>

		<div class="element-wrapper compact">
			<div class="element-actions actions-only">
				<a class="element-action element-action-fold" href="#"><i class="os-icon os-icon-minus-circle"></i></a>
			</div>
			<h6 class="element-header">
				Perfil Completado
			</h6>
			<div class="element-box-tp">
				<div class="fancy-progress-with-label">
					<div class="fpl-label">
					   <?php if ($this->idComercio == 1683) echo "65%"; else echo "0%"; ?>
					</div>
					<div class="fpl-progress-w">
						<div class="fpl-progress-i" style="width: <?php if ($this->idComercio == 1683) echo "65%"; else echo "0%"; ?>;"></div>
					</div>
				</div>
				<div class="todo-list">
					<a class="todo-item <?php if ($this->idComercio == 1683) echo "complete"; ?>" href="#">
						<div class="ti-info">
							<div class="ti-header">
								Conectar cuenta de banco
							</div>
							<div class="ti-sub-header">
								Tienes 1 cuenta sincronizada
							</div>
						</div>
						<div class="ti-icon">
							<?php if ($this->idComercio == 1683) { ?>

							<i class="os-icon os-icon-check"></i>
							<?php } else { ?>
							<i class="os-icon os-icon-arrow-right7"></i>

							<?php	}?>
						</div>
					</a>
					<a class="todo-item <?php if ($this->idComercio == 1683) echo "complete"; ?>" href="#">
						<div class="ti-info">
							<div class="ti-header">
								Cargar documentos fiscales
							</div>
							<div class="ti-sub-header">
								Ya tenemos tus documentos fiscales
							</div>
						</div>
						<div class="ti-icon">
						   <?php if ($this->idComercio == 1683) { ?>

							<i class="os-icon os-icon-check"></i>
							<?php } else { ?>
							<i class="os-icon os-icon-arrow-right7"></i>

							<?php	}?>
						</div>
					</a>
					<a class="todo-item" href="#">
						<div class="ti-info">
							<div class="ti-header">
								Fondear cuenta
							</div>
							<div class="ti-sub-header">
								Aun no has transferido fondos
							</div>
						</div>
						<div class="ti-icon">
							<i class="os-icon os-icon-arrow-right7"></i>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
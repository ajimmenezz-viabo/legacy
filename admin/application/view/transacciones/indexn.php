<div class="content-i" style="min-height: 950px;">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
                    <div class="tickets-control">
                        <h5>
                            Transacciones
                        </h5>
                    </div>
                </div>
				<?php		
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
				<div class="row pt-3">
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Ingresos
							</div>
							<div class="value">
								$<span id="lblTotalIngresos"><?php echo number_format($totalIngresos, 2, ".", ","); ?></span>
							</div>
							<!--<div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>-->
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
							<!--<div class="trending trending-down"><span>12%</span><i class="os-icon os-icon-arrow-down6"></i></div>-->
						</a>
					</div>
				</div>
				
                <div class="load-more-tickets">
                    <!--<a href="#"><span>Cargar más incidencias</span></a>-->
                </div>
            </div>
            <div class="support-ticket-content-w">
                <div class="support-ticket-content">
					
					<div id="detalle-archivo">
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

						$tipos = array("0" => "Crédito", "1" => "Débito", "2" => "Cargos");

						

					?>
						<h4>Detalle Transacciones</h4>
						<div class="tickets-filter form-inline">
						<?php
							if ($this->idComercio) {

								$terminales = ViaboModel::obtenerTerminales($this->idComercio);
							}	
						?>
							<div class="form-group mr-1">
								<label class="d-none d-md-inline-block mr-2">Terminal</label>
								<select name="idTerminal" id="idTerminal" class="form-control" onchange="javascript: filtrarTransacciones();" style="width: 120px;">
									<option value="-1">Todas</option>
									<?php
									if ($terminales) {
									foreach ($terminales as $terminal) {
							?>
									<option value="<?php echo $terminal->id; ?>" <?php if ($this->idTerminal == $terminal->id) echo "selected"; ?>><?php echo str_pad($terminal->id, 4, "0", STR_PAD_LEFT) . " - " . $terminal->terminal_type; ?></option>
							<?php
									}
								}
							?>
								</select>
							</div>

							<div class="form-group mr-1">
								<label class="d-none d-md-inline-block ml-2 mr-2">Mostrar</label>
								<select name="dias" id="dias" class="form-control" onchange="javascript: filtrarTransacciones();">
									<option value="0">Todas</option>
									<option value="7">7 días</option>
									<option value="15">15 días</option>
									<option value="30">30 días</option>
									<option value="45">45 días</option>
									<option value="60">60 días</option>
								</select>
							</div>
							<div class="form-group mr-1">
								<a href="#avanzado" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="avanzado" class="ml-2">
									<i class="os-icon os-icon-ui-83"></i>
								</a>
							</div>

							<div id="avanzado" class="collapse form-inline">
								<div class="form-group mr-1">
									<label class="d-none d-md-inline-block ml-2 mr-2">F. Inicio</label>
									<input type="text" name="fechaInicio" id="fechaInicio" class="form-control single-daterange" readonly style="width: 110px;" />
								</div>
								<div class="form-group mr-1">
									<label class="d-none d-md-inline-block ml-2 mr-2">F. Término</label>
									<input type="text" name="fechaTermino" id="fechaTermino" class="form-control single-daterange" readonly style="width: 110px;"  />
								</div>
								<div class="form-group mr-1">
									<a href="javascript: void(0);" onClick="javascript: filtrarTransaccionesFecha();" class="ml-2">
										<i class="os-icon os-icon-arrow-right"></i>
									</a>
								</div>
							</div>
							
							<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
						</div>
						<div class="row">
							<div class="col-md-12 mt-3 mb-3 filtros">
							<!--	
								<div class="filtrar-grupo" data-filter-group="dias">
									<a href="javascript: void(0); actualizarTotalesTablero('Siete');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">Mes actual</span></a>
									<a href="javascript: void(0); actualizarTotalesTablero('Siete');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">7 días</span></a>
									<a href="javascript: void(0); actualizarTotalesTablero('Quince');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">15 días</span></a>
									<a href="javascript: void(0); actualizarTotalesTablero('Treinta');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">30 días</span></a>
									<a href="javascript: void(0); actualizarTotalesTablero('Cuarenta y Cinco');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">45 días</span></a>
									<a href="javascript: void(0); actualizarTotalesTablero('Sesentaa');" class="filtrar"><span class="badge badge-pill badge-primary mr-1">60 días</span></a>
								</div>	
								
								
								<div class="filtrar-grupo" data-filter-group="marca-tarjeta">
									<a href="javascript: void(0); actualizarTotalesTransacciones('Visa');" class="filtrar" data-filter=".visa"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>
									<a href="javascript: void(0); actualizarTotalesTransacciones('MasterCard');" class="filtrar" data-filter=".master-card"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>
									<a href="javascript: void(0); actualizarTotalesTransacciones('Amex');" class="filtrar" data-filter=".amex"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>
								</div>
								
								
								<div class="filtrar-grupo" data-filter-group="estatus">
									<a href="javascript: void(0); actualizarTotalesTransacciones('Aprobada');" class="filtrar" data-filter=".aprobada"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>
									<a href="javascript: void(0); actualizarTotalesTransacciones('Reversada');" class="filtrar" data-filter=".reversada"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>
									<a href="javascript: javascript: void(0); actualizarTotalesTransacciones('NoAprobada');" class="filtrar" data-filter=".no-aprobada"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>
									<a href="javascript: javascript: void(0); actualizarTotalesTransacciones('Contracargo');" class="filtrar" data-filter=".contracargo"><span class="badge badge-pill badge-danger mr-1">Contracargo</span></a>
								</div>
							-->
								
								<a href="javascript: filtrarLocal('transacciones-dinamicas', 'visa'); actualizarTotalesTransacciones('Visa');" class="filtrar" data-filter=".visa"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>
								<a href="javascript: filtrarLocal('transacciones-dinamicas', 'master-card'); actualizarTotalesTransacciones('MasterCard');" class="filtrar" data-filter=".master-card"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>
								<a href="javascript: filtrarLocal('transacciones-dinamicas', 'amex'); actualizarTotalesTransacciones('Amex');" class="filtrar" data-filter=".amex"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>
								
								<a href="javascript: filtrarLocal('transacciones-dinamicas', 'aprobada'); actualizarTotalesTransacciones('Aprobada');" class="filtrar" data-filter=".aprobada"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>
								<a href="javascript: filtrarLocal('transacciones-dinamicas', 'reversada'); actualizarTotalesTransacciones('Reversada');" class="filtrar" data-filter=".reversada"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>
								<a href="javascript: javascript: filtrarLocal('transacciones-dinamicas', 'no-aprobada'); actualizarTotalesTransacciones('NoAprobada');" class="filtrar" data-filter=".no-aprobada"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>
								<a href="javascript: javascript: filtrarLocal('transacciones-dinamicas', 'contracargo'); actualizarTotalesTransacciones('Contracargo');" class="filtrar" data-filter=".contracargo"><span class="badge badge-pill badge-danger mr-1">Contracargo</span></a>
							</div>
						</div>
						<div id="transacciones-dinamicas">
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Fecha</th>
										<th>Tarjeta</th>
										<th>Tipo</th>
										<th>Importe</th>
										<th>Estatus</th>
										<th></th>
									</tr>
								</thead>
						<?php
							if ($this->transacciones["items"]) {
					
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
								<tr class="list-transacciones-dinamicas <?php echo str_replace(" ", "-", strtolower($transaccion->card_brand)); ?> <?php if ($transaccion->reversed) echo "reversada"; elseif ($transaccion->approved) echo "aprobada"; else echo "no-aprobada"; ?>">
									<td><input type="checkbox" name="idTransaccionCheck<?php echo $transaccion->id; ?>" id="idTransaccionCheck<?php echo $transaccion->id; ?>" value="<?php echo $transaccion->id; ?>" /></td>
									<td nowrap><?php echo substr($transaccion->transaction_date, 0, 10); ?> <?php echo substr($transaccion->transaction_date, 11, 5); ?></td>
									<td><?php echo $transaccion->card_brand; ?> - <?php echo $transaccion->card_number; ?></td>
									<td><?php echo $tipos[$transaccion->card_type]; ?></td>
									<td class="text-right"><strong>$<?php echo number_format($transaccion->amount, 2, ".", ","); ?></strong></td>
									<td class="text-center">
										<span class="badge badge-pill badge-<?php echo $color; ?>"><?php if ($transaccion->reversed) echo "Reversada"; elseif ($transaccion->approved) echo "Aprobada"; else echo "No Aprobada"; ?></span>
									</td>
									<td>
										<button aria-expanded="false" aria-haspopup="true" class="btn btn-white dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" type="button"><span class="sr-only">Toggle Dropdown</span></button>
										<div class="dropdown-menu" style="">
										  	<a class="dropdown-item ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/nuevaIncidencia/<?php echo $this->idComercio; ?>/Transaccion/<?php echo $transaccion->id; ?>"> Incidencia</a>
											<a class="dropdown-item ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>pins/nuevoPin/Transaccion/<?php echo $this->idComercio; ?>/<?php echo $transaccion->id; ?>"> Pin</a>
											<a class="dropdown-item ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>transacciones/comprobanteTransaccion/<?php echo $transaccion->id; ?>"> Comprobante</a>
										</div>
									</td>
								</tr>
						<?php
										// $totalIngresos+= $transaccion->amount;
										// $totalEgresos += $transaccion->amount-($transaccion->amount*$comision)-($transaccion->amount*$comision*0.16);
									}
								}
						?>
								<tfoot>
									<tr>
										<td colspan="4"></td>
										<td class="text-right"><strong>$<span id="lblTotalIngresos1"><?php echo number_format($totalIngresos, 2, ".", ","); ?></span></strong></td>
										<td colspan="2"></td>
									</tr>
								</tfoot>
							</table>

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
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

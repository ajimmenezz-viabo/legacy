<div class="content-i" style="min-height: 950px;">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
					
                    <div class="tickets-control">
                        <h5>
                            Historial Conciliaciones
                        </h5>
                    </div>
                </div>
				<?php				
					$totalImporte = 0;
					$totalComisiones = 0;
					$totalIVA = 0;
					$comision = 0;

					if ($this->transacciones["items"]) {
						foreach ($this->transacciones["items"] as $transaccion) {

							if ($transaccion->approved == 1 && $transaccion->reversed == 0) {

								if (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "0") {
									$comision = 0.0178;
								}elseif (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "1") {
									$comision = 0.014;
								}elseif ($transaccion->card_brand == "AMEX") {
									$comision = 0.027;
								}

								$totalImporte += $transaccion->amount;
								$totalComisiones += $transaccion->amount*$comision;
								$totalIVA += $transaccion->amount*$comision*0.16;
							}
						}
					}
				?>
				<div class="row pt-3">
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Total Importe
							</div>
							<div class="value">
								$<span id="lblTotalImporte"><?php echo number_format($totalImporte, 2, ".", ","); ?></span>
							</div>
							<!--<div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>-->
						</a>
					</div>
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Total Comisiones
							</div>
							<div class="value">
								$<span id="lblTotalComisiones"><?php echo number_format($totalComisiones, 2, ".", ","); ?></span>
							</div>
							<!--<div class="trending trending-down"><span>12%</span><i class="os-icon os-icon-arrow-down6"></i></div>-->
						</a>
					</div>
					<div class="col-12 col-sm-12 col-xxl-12">
						<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
							<div class="label">
								Total IVA
							</div>
							<div class="value">
								$<span id="lblTotalIVA"><?php echo number_format($totalIVA, 2, ".", ","); ?></span>
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
						$totalImporte = 0;
						$totalComisiones = 0;
						$totalIVA = 0;
						$comision = 0;
						$tipos = array("0" => "Crédito", "1" => "Débito", "2" => "Cargos");

						if ($this->transacciones["items"]) {

					?>
						<h4 class="mb-0">Detalle Comisiones</h4>
						<p><small>Periodo actual: 01 al 31 de Octubre</small></p>
						<div class="tickets-filter form-inline">
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
									<a href="javascript: void(0);" onClick="javascript: filtrarComisionesFecha();" class="ml-2">
										<i class="os-icon os-icon-arrow-right"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 mt-3 mb-3 filtros">
								<a href="javascript: filtrarLocal('reporte-comisiones', 'visa'); actualizarTotalesComisiones('Visa');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>
								<a href="javascript: filtrarLocal('reporte-comisiones', 'master-card'); actualizarTotalesComisiones('MasterCard');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>
								<a href="javascript: filtrarLocal('reporte-comisiones', 'amex'); actualizarTotalesComisiones('Amex');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>
								<a href="javascript: filtrarLocal('reporte-comisiones', 'credito'); actualizarTotalesComisiones('Credito');"><span class="badge badge-pill badge-success mr-1">Crédito</span></a>
								<a href="javascript: filtrarLocal('reporte-comisiones', 'debito'); actualizarTotalesComisiones('Debito');"><span class="badge badge-pill badge-success mr-1">Débito</span></a>
							</div>
						</div>
						<table id="reporte-comisiones" class="table table-striped">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Tarjeta</th>
									<th>Tipo</th>
									<th>Importe</th>
									<th>Comisión</th>
									<th>IVA</th>
								</tr>
							</thead>
					<?php
							$totalVisaImporte = 0;
							$totalVisaComisiones = 0;
							$totalVisaIVA= 0;

							$totalMasterCardImporte = 0;
							$totalMasterCardComisiones = 0;
							$totalMasterCardIVA= 0;

							$totalAmexImporte = 0;
							$totalAmexComisiones = 0;
							$totalAmexIVA= 0;

							$totalCreditoImporte = 0;
							$totalCreditoComisiones = 0;
							$totalCreditoIVA= 0;

							$totalDebitoImporte = 0;
							$totalDebitoComisiones = 0;
							$totalDebitoIVA= 0;

							foreach ($this->transacciones["items"] as $transaccion) {

								if ($transaccion->approved == 1 && $transaccion->reversed == 0) {

									if (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "0") {
										$comision = 0.0178;

										if ($transaccion->card_brand == "VISA") {
											$totalVisaImporte += $transaccion->amount;
											$totalVisaComisiones += $transaccion->amount*$comision;
											$totalVisaIVA += $transaccion->amount*$comision*0.16;
										} elseif ($transaccion->card_brand == "MASTER CARD") {
											$totalMasterCardImporte += $transaccion->amount;
											$totalMasterCardComisiones += $transaccion->amount*$comision;
											$totalMasterCardIVA += $transaccion->amount*$comision*0.16;
										}

										$totalCreditoImporte += $transaccion->amount;
										$totalCreditoComisiones += $transaccion->amount*$comision;
										$totalCreditoIVA += $transaccion->amount*$comision*0.16;

									} elseif (($transaccion->card_brand == "VISA" || $transaccion->card_brand == "MASTER CARD") && $transaccion->card_type == "1") {
										$comision = 0.014;

										if ($transaccion->card_brand == "VISA") {
											$totalVisaImporte += $transaccion->amount;
											$totalVisaComisiones += $transaccion->amount*$comision;
											$totalVisaIVA += $transaccion->amount*$comision*0.16;
										} elseif ($transaccion->card_brand == "MASTER CARD") {
											$totalMasterCardImporte += $transaccion->amount;
											$totalMasterCardComisiones += $transaccion->amount*$comision;
											$totalMasterCardIVA += $transaccion->amount*$comision*0.16;
										}

										$totalDebitoImporte += $transaccion->amount;
										$totalDebitoComisiones += $transaccion->amount*$comision;
										$totalDebitoIVA += $transaccion->amount*$comision*0.16;

									} elseif ($transaccion->card_brand == "AMEX") {
										$comision = 0.027;

										$totalAmexImporte += $transaccion->amount;
										$totalAmexComisiones += $transaccion->amount*$comision;
										$totalAmexIVA += $transaccion->amount*$comision*0.16;

										$totalCreditoImporte += $transaccion->amount;
										$totalCreditoComisiones += $transaccion->amount*$comision;
										$totalCreditoIVA += $transaccion->amount*$comision*0.16;

									} else $comosion = 0;
					?>
							<tr class="list-reporte-comisiones <?php echo str_replace(" ", "-", strtolower($transaccion->card_brand)); ?> <?php if($transaccion->card_type == "0") echo "credito"; ?> <?php if($transaccion->card_type == "1") echo "debito"; ?>">
								<td nowrap><?php echo substr($transaccion->transaction_date, 0, 10); ?></td>
								<td><?php echo $transaccion->card_brand; ?> - <?php echo $transaccion->card_number; ?></td>
								<td><?php echo $tipos[$transaccion->card_type]; ?></td>
								<td class="text-right">$<?php echo number_format($transaccion->amount, 2, ".", ","); ?></td>
								<td class="text-right">$<?php echo number_format($transaccion->amount*$comision, 2, ".", ","); ?></td>
								<td class="text-right">$<?php echo number_format($transaccion->amount*$comision*0.16, 2, ".", ","); ?></td>
							</tr>
					<?php
									$totalImporte += $transaccion->amount;
									$totalComisiones += $transaccion->amount*$comision;
									$totalIVA += $transaccion->amount*$comision*0.16;
								}
							}
					?>
							<tfoot>
								<tr>
									<td colspan="3"></td>
									<td class="text-right"><strong>$<span id="lblTotalImporte1"><?php echo number_format($totalImporte, 2, ".", ","); ?></span></strong></td>
									<td class="text-right"><strong>$<span id="lblTotalComisiones1"><?php echo number_format($totalComisiones, 2, ".", ","); ?></span></strong></td>
									<td class="text-right"><strong>$<span id="lblTotalIVA1"><?php echo number_format($totalIVA, 2, ".", ","); ?></span></strong></td>
								</tr>
							</tfoot>
						</table>

						<input type="hidden" name="totalVisaImporte" id="totalVisaImporte" value="<?php echo number_format($totalVisaImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalVisaComisiones" id="totalVisaComisiones" value="<?php echo number_format($totalVisaComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalVisaIVA" id="totalVisaIVA" value="<?php echo number_format($totalVisaIVA, 2, ".", ","); ?>" />

						<input type="hidden" name="totalMasterCardImporte" id="totalMasterCardImporte" value="<?php echo number_format($totalMasterCardImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalMasterCardComisiones" id="totalMasterCardComisiones" value="<?php echo number_format($totalMasterCardComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalMasterCardIVA" id="totalMasterCardIVA" value="<?php echo number_format($totalMasterCardIVA, 2, ".", ","); ?>" />

						<input type="hidden" name="totalAmexImporte" id="totalAmexImporte" value="<?php echo number_format($totalAmexImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalAmexComisiones" id="totalAmexComisiones" value="<?php echo number_format($totalAmexComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalAmexIVA" id="totalAmexIVA" value="<?php echo number_format($totalAmexIVA, 2, ".", ","); ?>" />

						<input type="hidden" name="totalCreditoImporte" id="totalCreditoImporte" value="<?php echo number_format($totalCreditoImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalCreditoComisiones" id="totalCreditoComisiones" value="<?php echo number_format($totalCreditoComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalCreditoIVA" id="totalCreditoIVA" value="<?php echo number_format($totalCreditoIVA, 2, ".", ","); ?>" />

						<input type="hidden" name="totalDebitoImporte" id="totalDebitoImporte" value="<?php echo number_format($totalDebitoImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalDebitoComisiones" id="totalDebitoComisiones" value="<?php echo number_format($totalDebitoComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalDebitoIVA" id="totalDebitoIVA" value="<?php echo number_format($totalDebitoIVA, 2, ".", ","); ?>" />

						<input type="hidden" name="totalImporte" id="totalImporte" value="<?php echo number_format($totalImporte, 2, ".", ","); ?>" />
						<input type="hidden" name="totalComisiones" id="totalComisiones" value="<?php echo number_format($totalComisiones, 2, ".", ","); ?>" />
						<input type="hidden" name="totalIVA" id="totalIVA" value="<?php echo number_format($totalIVA, 2, ".", ","); ?>" />
					<?php
						}	
					?>
						 
					</div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="content-i">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
                    <div class="tickets-control">
                        <h5>
                            Transacciones
                        </h5>
                        <!--
						<div class="element-search">
                            <input placeholder="Buscar..." type="text" />
                        </div>
						-->
                    </div>
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
						<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
						
						<div id="avanzado" class="collapse form-inline mt-3">
							<div class="form-group mr-1">
                           		<label class="d-none d-md-inline-block mr-2">F. Inicio</label>
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
                    </div>
                </div>
				<div id="calendario-mini" class="pe-3 ps-3 pb-3"></div>
				<div id="transacciones-dinamicas">
					<h6 class="font-size-14 ms-3 mb-1">Mes actual</h6>
					<div class="row">
						<div class="col-md-12 mb-2">
							<a href="javascript: filtrarLocal('transacciones-tablero', 'visa'); actualizarTotalesTablero('Visa');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>
							<a href="javascript: filtrarLocal('transacciones-tablero', 'master-card'); actualizarTotalesTablero('MasterCard');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>
							<a href="javascript: filtrarLocal('transacciones-tablero', 'amex'); actualizarTotalesTablero('Amex');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>
							<a href="javascript: filtrarLocal('transacciones-tablero', 'aprobada'); actualizarTotalesTablero('Aprobada');"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>
							<a href="javascript: filtrarLocal('transacciones-tablero', 'no-aprobada'); actualizarTotalesTablero('NoAprobada');"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>
							<a href="javascript: filtrarLocal('transacciones-tablero', 'reversada'); actualizarTotalesTablero('Reversada');"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>
						</div>
					</div>
		<?php		
			$totalVisa = 0;
			$totalMasterCard = 0;
			$totalAMEX = 0;
			$totalAprobada = 0;
			$totalNoAprobada = 0;
			$totalReversada = 0;
			$totalTransacciones = 0;		
					
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
						$totalAprobada = $transaccion->amount;
					} elseif (!($transaccion->approved)) {
						$color = "danger";
						$estatus = "No Aprobada";
						$totalNoAprobada = $transaccion->amount;
					} else {
						$color = "warning";
						$estatus = "";
					}

					if ($transaccion->card_brand =="AMEX") {
						$totalAMEX = $transaccion->amount;
					}elseif ($transaccion->card_brand == "VISA") {
						$totalVida = $transaccion->amount;
					} elseif ($transaccion->card_brand == "MASTER CARD") {
						$totalMasterCard = $transaccion->amount;
					}
				
		?>
					<a href="javascript: void(0);" class="list-transacciones-dinamicas ld-detalle-archivo mb-3 <?php echo str_replace(" ", "-", strtolower($transaccion->card_brand)); ?> <?php echo str_replace(" ", "-", strtolower($estatus)); ?>" data-href="<?php echo Config::get('URL'); ?>transacciones/detalleTransaccionDinamica/<?php echo $transaccion->id; ?>">
						<div class="support-ticket mb-3">
							<div class="st-meta">
								<div class="badge badge-<?php echo $color; ?> badge-pill">
									<?php if ($transaccion->reversed) echo "Reversada"; elseif ($transaccion->approved) echo "Aprobada"; else echo "No Aprobada"; ?>
								</div>
							</div>
							<div class="st-body">
								<div class="ticket-content">
									<h6 class="ticket-title">$ <?php echo number_format($transaccion->amount, 2, ".", ","); ?> <small class="text-muted ml-2"><?php echo Text::title($transaccion->card_brand); ?> - <?php echo $transaccion->card_number; ?></small>
									</h6>
									<div class="ticket-description">
										<small class="text-muted"><?php echo substr($transaccion->transaction_date, 0, 10); ?> <?php echo substr($transaccion->transaction_date, 11, 5); ?></small>
									</div>
								</div>
							</div>
							<div class="st-foot">
								<span class="label">Terminal:</span><span class="value"><?php echo $transaccion->terminal_id; ?></span>
							<?php
								 if ($transaccion->authorization_number) {
							?>
								<span class="label">Aut.:</span><span class="value"><?php echo $transaccion->authorization_number; ?></span>
							<?php
								 }
							?>
								<span class="label">Emisor:</span><span class="value"><?php echo substr($transaccion->issuer, 0, 15); ?></span>
							</div>
						</div>
					</a>
		<?php
				}
			}		
		?>		
					<input type="hidden" name="totalVisa" id="totalVisa" value="<?php echo $totalVisa; ?>" />
					<input type="hidden" name="totalMasterCard" id="totalMasterCard" value="<?php echo $totalMasterCard; ?>" />
					<input type="hidden" name="totalAMEX" id="totalAMEX" value="<?php echo $totalAMEX; ?>" />
					<input type="hidden" name="totalAprobada" id="totalAprobada" value="<?php echo $totalAprobada; ?>" />
					<input type="hidden" name="totalNoAprobada" id="totalNoAprobada" value="<?php echo $totalNoAprobada; ?>" />
					<input type="hidden" name="totalReversada" id="totalReversada" value="<?php echo $totalReversada; ?>" />
					<input type="hidden" name="totalTransacciones" id="totalTransacciones" value="<?php echo $totalTransacciones; ?>" />
				</div>
                
                <div class="load-more-tickets">
                    <!--<a href="#"><span>Cargar más incidencias</span></a>-->
                </div>
            </div>
            <div class="support-ticket-content-w">
                <div class="support-ticket-content">
					<div id="detalle-archivo">
						 <div class="support-ticket-content-header">
							<h3 class="ticket-header">

							</h3>
							<a class="back-to-index" href="#"><i class="os-icon os-icon-arrow-left5"></i><span>Regresar</span></a><a class="show-ticket-info" href="#"><span>Ver detalles</span><i class="os-icon os-icon-documents-03"></i></a>
						</div>
						<div class="ticket-thread">


						</div>
					</div>
                </div>
                <div class="support-ticket-info-1">
                    <a class="close-ticket-info" href="#"><i class="os-icon os-icon-ui-23"></i></a>
					<div id="accion-rapida"></div>
                </div>
            </div>
        </div>
        
    </div>

<div class="content-i" style="min-height: 950px;">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
                    <div class="tickets-control">
                        <h5>
                            Movimientos
                        </h5>
                    </div>
                </div>
				<div id="movimientos-dinamicas">
					<h6 class="font-size-14 ms-3 mb-3">Tarjetas</h6>
		<?php		
			if ($this->tarjetas && $this->idComercio == 1683) {
				foreach ($this->tarjetas as $tarjeta) {
					
					$balance = ViaboModel::obtenerBalance($tarjeta->tarjeta);
		?>
					<a href="javascript: void(0);" class="list-movimientos-dinamicas ld-detalle-archivo mb-3" data-href="<?php echo Config::get('URL'); ?>movimientos/index/<?php echo $this->idComercio; ?>/<?php echo $tarjeta->tarjeta; ?>" style="text-decoration: none !important;">
						<div class="support-ticket mb-3 <?php if ($tarjeta->tarjeta == $this->idTarjeta) echo "active"; ?>">
							<div class="st-meta">
								<?php
									if ($balance->Status == "Unblocked" || $balance->Status == "UnBlocked") echo "<i class=\"bx bx-lock-open text-success\"></i>";
									elseif ($balance->Status == "Blocked") echo "<i class=\"bx bx-lock text-danger\"></i>";
								?>
							</div>
							<div class="st-body">
								<div class="ticket-content">
									<h6 class="ticket-title"><?php echo Text::title($tarjeta->nombreCompleto); ?> <small class="text-muted ml-2">Master Card - <?php echo substr($tarjeta->tarjeta, 4, 4); ?></small>
									</h6>
									<div class="ticket-description">
										<small class="text-muted"><?php echo substr($balance->Date, 0, 16); ?></small>
									</div>
								</div>
							</div>
							<div class="st-foot">
								<span class="label">Saldo:</span><span class="value">$<?php echo number_format($balance->Balance, 2, ".", ","); ?> <small>MXN</small></span>
							</div>
						</div>
					</a>
		<?php
				}
			}		
		?>		</div>
                
                <div class="load-more-tickets">
                    <!--<a href="#"><span>Cargar más incidencias</span></a>-->
                </div>
            </div>
            <div class="support-ticket-content-w">
                <div class="support-ticket-content">
					<div id="detalle-archivo">
						
							<h4>Movimientos -  <?php echo substr($this->idTarjeta, 4, 4); ?></h4>
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
										<a href="javascript: void(0);" onClick="javascript: filtrarMovimientosFecha();" class="ml-2">
											<i class="os-icon os-icon-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mt-3 mb-3 filtros">
									<a href="javascript: filtrarLocal('movimientos-dinamicos', 'cargo');"><span class="badge badge-pill badge-danger mr-1">Cargo</span></a>
									<a href="javascript: filtrarLocal('movimientos-dinamicos', 'abono');"><span class="badge badge-pill badge-success mr-1">Abono</span></a>
								</div>
							</div>
							<div id="movimientos-dinamicos">
								<table class="table table-striped">
									<thead>
										<tr>
											<th></th>
											<th>Fecha</th>
											<th>Descripción</th>
											<th>Autorización</th>
											<th>Cargo</th>
											<th>Abono</th>
											<th>Disponible</th>
											<th></th>
										</tr>
									</thead>
							<?php
							// echo var_dump($this->movimientos);	
									
									
							if ($this->movimientos->TicketMessage) {
						
									$totalCargos = 0;
									$totalAbonos = 0;

									foreach ($this->movimientos->TicketMessage as $movimiento) {
							?>
									<tr class="<?php if ($movimiento->charge > 0.00) echo "cargo"; elseif ($movimiento->Accredit > 0.00) echo "abono"; ?>">
										<td><input type="checkbox" name="idMovimientoCheck<?php echo $movimiento->Transaction_Id; ?>" id="idMovimientoCheck<?php echo $movimiento->Transaction_Id; ?>" value="<?php echo $movimiento->Transaction_Id; ?>" /></td>
										<td nowrap><?php echo $movimiento->Date; ?></td>
										<td><?php echo Text::title($movimiento->Merchant); ?></td>
										<td><?php echo $movimiento->Auth_Code; ?></td>
										<td class="text-right">$<?php echo number_format($movimiento->charge, 2, ".", ","); ?></td>
										<td class="text-right">$<?php echo number_format($movimiento->Accredit, 2, ".", ","); ?></td>
										<td class="text-right">$<?php echo number_format($movimiento->Vailable, 2, ".", ","); ?></td>
										<td>
											<button aria-expanded="false" aria-haspopup="true" class="btn btn-white dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" type="button"><span class="sr-only">Toggle Dropdown</span></button>
											<div class="dropdown-menu" style="">
												<a class="dropdown-item ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/nuevaIncidencia/<?php echo $this->idComercio; ?>/Movimiento/<?php echo $movimiento->Transaction_Id; ?>"> Incidencia</a>
												<a class="dropdown-item ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>pins/nuevoPin/<?php echo $this->idComercio; ?>/Movimiento/<?php echo $movimiento->Transaction_Id; ?>"> Pin</a>
											</div>
										</td>
									</tr>
							<?php
										$totalCargos += $movimiento->charge;
										$totalAbonos += $movimiento->Accredit;
									}
								}	
							?>
									<tfoot>
										<tr>
											<td colspan="4"></td>
											<td class="text-right"><strong>$<?php echo number_format($totalCargos, 2, ".", ","); ?></strong></td>
											<td class="text-right"><strong>$<?php echo number_format($totalAbonos, 2, ".", ","); ?></strong></td>
											<td></td>
										</tr>
									</tfoot>
								</table>
							</div>
						<?php
								
						?>
						
						 
					</div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Detalle Tarjeta <?php echo $this->tarjeta->tarjeta . " - " . $this->tarjeta->ultimosDigitos; ?></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                    <li class="breadcrumb-item active">Tarjetas</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
				
				<?php $this->renderFeedbackMessages(); ?>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                           
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <p class="text-muted mb-2">Saldo inicial</p>
                                            <h5>$ <?php echo number_format($this->saldo->saldo, 2, ".", ","); ?></h5>
											<small class="text-muted"><?php echo $this->saldo->fecha; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-sm-end mt-4 mt-sm-0">
                                            <p class="text-muted mb-2">Disponible</p>
                                            <h5>$ <?php echo number_format($this->saldo->disponible, 2, ".", ","); ?></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top">
                                <p class="text-muted mb-4">
									En el periodo
									
									<a class="md-modal font-size-18" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>tarjetas/corteTarjeta/<?php echo $this->idTarjeta; ?>" style="float: right;" data-bs-container="#icon-container-right" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Corte"><span class="bx bx-transfer-alt"></span></a>
								</p>
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div>
                                                <div class="font-size-24 text-primary mb-2">
                                                    <i class="bx bx-wallet"></i>
                                                </div>

                                                <p class="text-muted mb-2">Compras</p>
                                                <h5>$ <?php echo number_format($this->saldo->compras, 2, ".", ","); ?></h5>

                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mt-4 mt-sm-0">
                                                <div class="font-size-24 text-primary mb-2">
                                                    <i class="bx bx-credit-card"></i>
                                                </div>

                                                <p class="text-muted mb-2">Gastos</p>
                                                <h5>$ <?php echo number_format($this->saldo->gastos, 2, ".", ","); ?></h5>

                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mt-4 mt-sm-0">
                                                <div class="font-size-24 text-primary mb-2">
                                                    <i class="bx bx-money"></i>
                                                </div>

                                                <p class="text-muted mb-2">Abonos</p>
                                                <h5>$ <?php echo number_format($this->saldo->abonos, 2, ".", ","); ?></h5>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="me-3 align-self-center">
                                                <i class=" bx bx-dollar  h2 text-warning mb-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Pago Mínimo</p>
                                                <h5 class="mb-0"><?php echo number_format($this->saldo->pagoMinimo, 2, ".", ","); ?> <small>MXN</small></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="me-3 align-self-center">
                                                <i class=" bx bx-dollar  h2 text-primary mb-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Pago No Generar Intereres</p>
                                                <h5 class="mb-0"><?php echo number_format($this->saldo->pagoNoIntereses, 2, ".", ","); ?> <small>MXN</small></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="me-3 align-self-center">
                                                <i class=" bx bx-dollar  h2 text-info mb-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Pago Total</p>
                                                <h5 class="mb-0"><?php echo number_format($this->saldo->pagoTotal, 2, ".", ","); ?> <small>MXN</small></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Historial</h4>

                                <div>
                                    <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Movimientos
									<a href="" class="btn btn-primary btn-sm mb-3 float-end"><i class="bx bx-plus"></i> Abono Tarjeta</a>
								</h4>
								<div class="filters mb-2">
									<i class="bx bx-filter-alt"></i> &nbsp; 
							<?php
								if ($this->proveedores) {
									foreach ($this->proveedores as $proveedor) {
							?>
										<a href="#"><span class="badge badge-pill badge-soft-info font-size-11"><?php echo $proveedor->proveedor; ?></span></a>
							<?php
									}
								}		
							?>
								</div>
                                <ul class="nav nav-tabs nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Todos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Compras</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Gastos</a>
                                    </li>
									<li class="nav-item">
                                        <a class="nav-link" href="#">Abonos</a>
                                    </li>
                                </ul>

                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
													<th style="width: 3%;">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" id="checkAll">
														</div>
													</th>
                                                    <th>No.</th>
                                                    <th>Proveedor</th>
                                                    <th>Fecha</th>
                                                    <th>Monto</th>
                                                    <th>Referencia</th>
                                                    <th>Asesor</th>
                                                </tr>
                                            </thead>
											<tbody>
                                        <?php
											if ($this->movimientos) {
												foreach ($this->movimientos as $movimiento) {
										?>
											<tr>
												<td>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="formCheck2" value="<?php echo $movimiento->idPago; ?>" />
													</div>
												</td>
												<td>
													<a href="<?php echo Config::get('URL'); ?>reservaciones/detalleReservacion/<?php echo $movimiento->idReservacion; ?>">
														<?php echo str_pad($movimiento->idReservacion, 5, "0", STR_PAD_LEFT); ?>
													</a>
												</td>
												<td><?php echo $movimiento->proveedor; ?></td>
												<td><?php echo $movimiento->fechaLetra; ?></td>
												<td class="text-end">$<?php echo number_format($movimiento->monto, 2, ".", ","); ?></td>
												<td><?php echo $movimiento->referencia; ?></td>
												<td><?php echo $movimiento->asesor; ?></td>
											</tr>
										<?php
												}	
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
				
				<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Cortes</h4>
								
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Pago Mínimo</th>
                                                    <th>Pago No Intereses</th>
                                                    <th>Pago Total</th>
                                                    <th>Saldo</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
											<tbody>
                                        <?php
											if ($this->cortes) {
												foreach ($this->cortes as $corte) {
										?>
											<tr>
												<td class="text-end">$<?php echo number_format($corte->pagoMinimo, 2, ".", ","); ?></td>
												<td class="text-end">$<?php echo number_format($corte->pagoNoIntereses, 2, ".", ","); ?></td>
												<td class="text-end">$<?php echo number_format($corte->pagoTotal, 2, ".", ","); ?></td>
												<td class="text-end">$<?php echo number_format($corte->saldo, 2, ".", ","); ?></td>
												<td><?php echo $corte->fecha; ?></td>
											</tr>
										<?php
												}	
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
            </div>
        </div>
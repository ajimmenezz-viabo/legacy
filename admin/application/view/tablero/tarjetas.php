				<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
                    <div class="content-i">
                        <div class="content-box">
                            <div class="os-tabs-w">
                                <div class="os-tabs-controls os-tabs-complex">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo Config::get('URL'); ?>tablero">
                                                <img src="<?php echo Config::get('URL'); ?>img/icono-pay.png"  height="24" class="m-1 mr-2" /> <span class="tab-label">Viabo Pay</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="<?php echo Config::get('URL'); ?>tablero/tarjetas">
                                                <img src="<?php echo Config::get('URL'); ?>img/icono-card.png" height="32" class="mr-2" /> <span class="tab-label">Viabo Card</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
							
							<?php
								$balance = ViaboModel::obtenerBalance($this->idTarjeta);
							?>
                            <div class="row">
                                <div class="col-sm-12 col-lg-4 col-xxl-3">
                                    <div class="element-balances justify-content-between mobile-full-width">
                                        <div class="balance balance-v2">
                                            <div class="balance-title">
                                                Saldo disponible
                                            </div>
                                            <div class="balance-value">
                                                <span class="d-xxl-none"><?php if ($this->idComercio == 1683) echo "$" . number_format($balance->Balance, 2, ".", ","); else echo "$0.00"; ?></span><span class="d-none d-xxl-inline-block"><?php if ($this->idComercio == 1683) echo "$" . number_format($balance->Balance, 2, ".", ","); else echo "$0.00"; ?></span>
                                            </div>
                                        </div>
                                    </div>
									<div class="balance-table mb-4">
										<table class="table table-lightborder table-bordered table-v-compact mb-0">
											<tr>
												<td>
													<strong>$0.00</strong>
													<div class="balance-label smaller lighter text-nowrap">
														Ingresos
													</div>
												</td>
												<td>
													<strong>$0.00</strong>
													<div class="balance-label smaller lighter text-nowrap">
														Egresos
													</div>
												</td>
											</tr>
										</table>
									</div>
                                    <div class="element-wrapper pb-4 mb-4 border-bottom">
                                        <div class="element-box-tp">
                                            <a class="btn btn-primary ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>dispersiones/nuevaDispersion/<?php echo $this->idComercio; ?>/<?php echo $this->idTarjeta; ?>"><i class="os-icon os-icon-log-out"></i><span>Dispersión tarjetas</span></a>
											
											<!--<a class="btn btn-grey" href="<?php echo Config::get('URL'); ?>tarjetas/fondeoTarjetas"><i class="os-icon os-icon-credit-card"></i><span>Fondeo saldo</span></a>-->
                                        </div>
										
                                    </div>
									<h5 class="pt-3">Detalle Tarjeta - <?php echo substr($this->idTarjeta, strlen($this->idTarjeta)-4, 4); ?></h2>
									<div class="row pt-2">
										<div class="col-12 col-sm-12 col-xxl-12">
											<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
												<div class="label">
													Abonos
												</div>
												<div class="value text-success">
													$<?php echo number_format($totalAbonos, 2, ".", ","); ?>
												</div>
												<!--<div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>-->
											</a>
										</div>
										<div class="col-12 col-sm-12 col-xxl-12">
											<a class="element-box el-tablo centered trend-in-corner smaller" href="#">
												<div class="label">
													Cargos
												</div>
												<div class="value text-danger">
													$<?php echo number_format($totalCargos, 2, ".", ","); ?>
												</div>
												<!--<div class="trending trending-down"><span>12%</span><i class="os-icon os-icon-arrow-down6"></i></div>-->
											</a>
										</div>
									</div>
                                </div>
								
								<div class="col-sm-12 col-lg-6 col-xxl-6 ml-2">
									 <div class="element-wrapper compact pt-4">
                                        <div class="element-actions d-none d-sm-block">
                                            <a class="btn btn-primary btn-sm ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>cobros/referenciaComercio/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-hash"></i><span>Ref. Comercio</span></a>
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
                                                                    <i class="os-icon os-icon-plus"></i>
                                                                </div>
                                                                <div class="pt-user-name">
                                                                    Agregar<br />
                                                                    Tarjeta
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
													
											<?php
												$i = 0;	
													
												if ($this->tarjetas) {
													foreach ($this->tarjetas as $tarjeta) {
														
														$i++;
														$balance = ViaboModel::obtenerBalance($tarjeta->tarjeta);
											?>	
													<div class="col-4 col-sm-3 col-xxl-3">
                                                        <div class="profile-tile profile-tile-inlined">
                                                            <a class="profile-tile-box" href="<?php echo Config::get('URL'); ?>movimientos/index/<?php echo $this->idComercio; ?>/<?php echo $tarjeta->tarjeta; ?>">
                                                                <div class="pt-new-icon">
																	<?php
																		if ($balance->Status == "Unblocked" || $balance->Status == "UnBlocked") echo "<i class=\"os-icon os-icon-unlock\"></i>";
																		elseif ($balance->Status == "Blocked") echo "<i class=\"os-icon os-icon-lock\"></i>";
																	?>
                                                                </div>
                                                                <div class="pt-user-name">
                                                                    <?php echo Text::title($tarjeta->nombre) . " " . substr($tarjeta->apellidos, 0, 1) . "."; ?><br /><small class="text-muted ml-2">Master Card - <?php echo substr($tarjeta->tarjeta, 4, 4); ?></small>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
											<?php
														if ($i == 3) break;
														
													}
												} 		
											?>
                                                </div>
												<div class="row">
													<div class="col-md-12">
														 <a class="centered-load-more-link" href="<?php echo Config::get('URL'); ?>movimientos/index/<?php echo $this->idComercio; ?>"><span>Ver todas tarjetas</span></a>
													</div>
												</div>
                                            </div>
                                        </div>
									</div>
                                    <div class="element-wrapper compact pt-5">
                                        <div class="element-actions pt-2">
                                            <form class="form-inline justify-content-sm-end">
                                                <label class="smaller" for="">Filtrar Por</label>
                                                <select class="form-control form-control-sm form-control-faded">
                                                    <option value="0">
                                                        Día
                                                    </option>
                                                    <option value="7">
                                                        Últimos 7 días
                                                    </option>
													<option value="15">
                                                        Últimos 15 días
                                                    </option>
                                                    <option value="30" selected>
                                                        Últimos 30 días
                                                    </option>
                                                </select>
                                            </form>
                                        </div>
                                        <h6 class="element-header mb-3">
                                            Últimos Movimientos
                                        </h6>
										<div class="row">
											<div class="col-md-12 mb-2">
												<a href="javascript: filtrarLocal('transacciones-tablero', 'cargo');"><span class="badge badge-pill badge-danger mr-1">Cargo</span></a>
												<a href="javascript: filtrarLocal('transacciones-tablero', 'abono');"><span class="badge badge-pill badge-success mr-1">Abono</span></a>
											</div>
										</div>
                                        <div class="element-box-tp" style="max-height: 650px; overflow-y: scroll;" id="transacciones-tablero">
                                            <table class="table table-clean">
										<?php	
											if ($this->movimientos->TicketMessage) {
												foreach ($this->movimientos->TicketMessage as $movimiento) {
													
													$color = "";

													if ($movimiento->Accredit > 0.00) {
														$color = "success";
														$estatus = "Abono";
													} elseif ($movimiento->charge > 0.00) {
														$color = "danger";
														$estatus = "Cargo";
													} else {
														$color = "warning";
														$estatus = "";
													}
										?>
												<tr class="list-transacciones-tablero <?php if ($movimiento->charge > 0.00) echo "cargo"; elseif ($movimiento->Accredit > 0.00) echo "abono"; ?>">
                                                    <td>
                                                        <div class="value">
                                                            <?php echo Text::title($movimiento->Merchant); ?>
                                                        </div>
                                                        <span class="sub-value"><span class="text-<?php echo $color; ?>"><?php if ($movimiento->charge > 0.00) echo "Cargo"; elseif ($movimiento->Accredit > 0.00) echo "Abono"; ?></span></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="value">
                                                            $<?php if ($movimiento->charge > 0.00) echo number_format($movimiento->charge, 2, ".", ","); elseif ($movimiento->Accredit > 0.00) echo number_format($movimiento->Accredit, 2, ".", ","); ?> <small>MXN</small>
                                                        </div>
                                                        <span class="sub-value"><?php echo substr($movimiento->Date, 0, 10); ?> <?php echo substr($movimiento->Date, 11, 5); ?></span>
                                                    </td>
                                                </tr>
										<?php
												}	
											}		
										?>
                                            </table>
                                            <a class="centered-load-more-link" href="<?php echo Config::get('URL'); ?>movimientos/index/<?php echo $this->idComercio; ?>/<?php echo $this->idTarjeta; ?>"><span>Ver todos movimientos</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
							<div class="row pt-2">
                                <div class="col-6 col-sm-3 col-xxl-2">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Bitcoin Price
                                        </div>
                                        <div class="value">
                                            $7.484
                                        </div>
                                        <div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 col-xxl-2">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Last Month
                                        </div>
                                        <div class="value text-danger">
                                            -$3,248
                                        </div>
                                        <div class="trending trending-down"><span>12%</span><i class="os-icon os-icon-arrow-down6"></i></div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 col-xxl-2">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Etherium Price
                                        </div>
                                        <div class="value">
                                            $784.12
                                        </div>
                                        <div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 col-xxl-2">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Ripple Price
                                        </div>
                                        <div class="value">
                                            $1,284
                                        </div>
                                        <div class="trending trending-up"><span>12%</span><i class="os-icon os-icon-arrow-up6"></i></div>
                                    </a>
                                </div>
                                <div class="col-6 col-xxl-2 d-sm-none d-xxl-block">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Litecoin Price
                                        </div>
                                        <div class="value">
                                            -$3,473
                                        </div>
                                        <div class="trending trending-down"><span>5%</span><i class="os-icon os-icon-arrow-down6"></i></div>
                                    </a>
                                </div>
                                <div class="col-6 col-xxl-2 d-sm-none d-xxl-block">
                                    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                                        <div class="label">
                                            Last Month
                                        </div>
                                        <div class="value">
                                            -$3,248
                                        </div>
                                        <div class="trending trending-down"><span>12%</span><i class="os-icon os-icon-arrow-down6"></i></div>
                                    </a>
                                </div>
                            </div>
							-->
                            
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
                    </div>
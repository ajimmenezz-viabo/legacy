<div class="content-i">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
                    <div class="tickets-control">
                        <h5>
                            Incidencias
                        </h5>
                        <div class="element-search">
                            <input placeholder="Buscar..." type="text" />
                        </div>
                    </div>
                    <div class="tickets-filter form-inline">
                        <div class="form-group mr-3">
                            <label class="d-none d-md-inline-block mr-2">Estatus</label>
                            <select class="form-control" style="width: 120px;">
                                <option>Todos</option>
                                <option>Cerrada</option>
                                <option>Abierta</option>
                                <option>Pendiente</option>
                            </select>
                        </div>
						<div class="form-group mr-1">
                            <label class="d-none d-md-inline-block mr-2">Agente</label>
                            <select class="form-control" style="width: 120px;">
								<option>Todos</option>
						<?php
							if ($this->usuarios) {
								foreach ($this->usuarios as $usuario) {
						?>
								<option value="<?php echo $usuario->idUsuario; ?>" <?php if ($this->idUsuario == $usuario->idUsuario) echo "selected"; ?>><?php echo $usuario->nombre . " " . $usuario->apellidos; ?></option>						<?php
								}
							}		
						?>
							</select>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-12 mb-3">
							
						<?php
							if ($this->categorias) {
								foreach ($this->categorias as $categoria) {
						?>
							<a href="javascript: filtrarLocal('incidencias-dinamicas', '<?php echo strtolower($categoria->categoria); ?>');"><span class="badge badge-pill badge-<?php echo $categoria->color; ?> mr-1 mb-1"><?php echo $categoria->categoria; ?></span></a>
						<?php
								}
							}
						?>
						</div>
					</div>
                </div>
				
				<div id="incidencias-dinamicas">
				<?php
					if ($this->incidencias) {
						foreach ($this->incidencias as $incidencia) {
				?>
					<a href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/detalleIncidencia/<?php echo $incidencia->idIncidencia; ?>/<?php echo $incidencia->idComercio; ?>" class="list-incidencias-dinamicas ld-detalle-contenido-center <?php echo strtolower($incidencia->categoria); ?>" style="text-decoration: none !important;" onClick="javascript: activarIncidencia(<?php echo $incidencia->idIncidencia; ?>)">
						<div class="incidencia-item support-ticket <?php if ($incidencia->idIncidencia == $this->idIncidencia) echo "active"; ?> mb-3" id="incidencia<?php echo $incidencia->idIncidencia; ?>">
							<div class="st-meta">
								<div class="badge badge-<?php echo $incidencia->color; ?> badge-pill">
									<?php echo $incidencia->categoria; ?>
								</div>
								<div class="status-pill green"></div>
							</div>
							<div class="st-body">
								<div class="avatar">
									<img alt="" src="<?php echo Config::get('URL'); ?>img/usuarios/avatar<?php echo $incidencia->idUsuario; ?>.jpg" />
								</div>
								<div class="ticket-content">
									<h6 class="ticket-title">
										<?php echo $incidencia->incidencia; ?>
									</h6>
									<div class="ticket-description">
										<?php if (strlen($incidencia->descripcion) > 120) echo substr($incidencia->descripcion, 0, 120) . "..."; else echo $incidencia->descripcion; ?>
									</div>
								</div>
							</div>
							<div class="st-foot">
								<span class="label"><i class="os-icon os-icon-user"></i></span><span class="value"><?php echo $incidencia->asesor; ?></span><span class="label"><i class="os-icon os-icon-clock"></i></span><span class="value"><?php if ($incidencia->ultimaActualizacion) echo $incidencia->ultimaActualizacionLetra; else echo $incidencia->fechaCreacionLetra; ?></span>
							</div>	
						</div>
					</a>
				<?php
						}	
					}	
				?>
				</div>	
                <div class="load-more-tickets">
                    <!--<a href="#"><span>Cargar más incidencias</span></a>-->
                </div>
            </div>
            <div class="support-ticket-content-w" id="detalle-contenido-center">
                <?php
					if ($this->idIncidencia) {

						$this->View = new View();

						$this->View->renderWithoutHeaderAndFooter('incidencias/detalle', array(
							'incidencia' => IncidenciasModel::obtenerIncidencia($this->idIncidencia),
							'anotaciones' => IncidenciasModel::obtenerAnotacionesIncidencia($this->idIncidencia, "-1"),
							'usuarios' => IncidenciasModel::obtenerUsuariosIncidencia($this->idIncidencia),
							'idIncidencia' => $this->idIncidencia
						));	

					}
				?>
            </div>
        </div>
    </div>
</div>

	<div class="support-ticket-content">
		<a href="javascript: void(0);" class="ld-accion-rapida-right right-bar-toggle" data-href="<?php echo Config::get('URL'); ?>incidencias/editarIncidencia/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>" style="float: right;" class="float-right"><i class="os-icon os-icon-edit-1"></i></a>
		<h5 class="info-header color-primary">
			I-<?php echo str_pad($this->idIncidencia, 4, "0", STR_PAD_LEFT); ?> 
			<div class="badge badge-<?php echo $this->incidencia->color; ?> badge-pill" style="margin-top: 2px !important; margin-left: 5px; position: absolute;">
				<?php echo $this->incidencia->categoria; ?>
			</div>
		</h5>
		<div class="support-ticket-content-header">
			<h3 class="ticket-header">
				<?php echo $this->incidencia->incidencia; ?>
				<div class="status-pill green"></div>
			</h3>
			<a class="back-to-index" href="#"><i class="os-icon os-icon-arrow-left5"></i><span>Regresar</span></a><a class="show-ticket-info" href="#"><span>Ver detalles</span><i class="os-icon os-icon-documents-03"></i></a>
		</div>
		<p><?php echo $this->incidencia->descripcion; ?></p>
		
		<div class="row">
			
			<div class="col-md-3 text-center mb-3">
				<h1><span class="badge badge-pill badge-primary badge-lg">Cadena</span></h1>
			</div>
			<div class="col-md-3 text-center mb-3">
				<h1><span class="badge badge-pill badge-primary">Comercio</span></h1>
			</div>
			<div class="col-md-3 text-center mb-3">
				<h1><span class="badge badge-pill badge-primary">Terminal</span></h1>
			</div>
			<div class="col-md-3 text-center mb-3">
				<h1><span class="badge badge-pill badge-danger">Cliente</span></h1>
			</div>
		</div>
		<div class="ticket-thread">
		<?php
			if ($this->anotaciones) {
				foreach ($this->anotaciones as $anotacion) {
					
					$adjuntos = IncidenciasModel::obtenerAdjuntosAnotacionIncidencia($anotacion->idAnotacion);
		?>
			<div class="ticket-reply <?php if ($anotacion->idUsuario == Session::get('idUsuario')) echo "highlight"; ?>">
				<div class="ticket-reply-info">
					<a class="author with-avatar" href="#"><img alt="" src="<?php echo Config::get('URL'); ?>img/usuarios/avatar<?php echo $anotacion->idUsuario; ?>.jpg" /><span><?php echo $anotacion->asesor; ?></span></a>
					<span class="info-data"><span class="label">respondió</span><span class="value"><?php echo $anotacion->fechaCreacionLetra; ?></span></span>
					<div class="actions" href="#">
						<i class="os-icon os-icon-ui-46"></i>
						<div class="actions-list">
							<a href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/editarAnotacionIndicidencia/<?php echo $anotacion->idAnotacion; ?>/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>" class="ld-accion-rapida-right right-bar-toggle"><i class="os-icon os-icon-ui-49"></i><span>Editar</span></a>
							<a href="#"><i class="os-icon os-icon-ui-09"></i><span>Marcar privado</span></a>
							<!--<a class="danger" href="#"><i class="os-icon os-icon-ui-15"></i><span>Eliminar</span></a>-->
						</div>
					</div>
				</div>
				<div class="ticket-reply-content">
					<p>
						<?php echo $anotacion->anotacion; ?>
					</p>
				</div>
				<div class="ticket-attachments">
				<?php
					if ($adjuntos) {
						foreach ($adjuntos as $adjunto) {
				?>
					
				<?php
						}
					}
				?>
				</div>
			</div>
		<?php
				}
			}	
		?>
		</div>
		<div class="row">
			<div class="col-md-4 offset-md-2 pt-2 mb-2">
				<a class="btn btn-primary btn-block btn-md ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/nuevaAnotacionIncidencia/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-message-square"></i><span>Agregar anotación</span></a>
			</div>
			<div class="col-md-4 pt-2 mb-2">
				<a class="btn btn-success btn-block btn-md ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/cerrarIncidencia/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-check"></i><span>Cerrar incidencia</span></a>
			</div>
		</div>
	</div>
	<div class="support-ticket-info">
		<a class="close-ticket-info" href="#"><i class="os-icon os-icon-ui-23"></i></a>
		<div class="customer">
			<div class="avatar">
				<img alt="<?php echo $this->incidencia->asesor; ?>" src="<?php echo Config::get('URL'); ?>img/usuarios/avatar<?php echo $this->incidencia->idUsuario; ?>.jpg" />
			</div>
			<h4 class="customer-name">
				<?php echo $this->incidencia->asesor; ?>
			</h4>
			<div class="customer-tickets">
				<?php // echo $this->incidencia->perfil; ?>
			</div>
		</div>
		<h5 class="info-header">
			Detalles
		</h5>
		<div class="info-section text-center">
			<div class="label">
				Fecha Creación
			</div>
			<div class="value">
				<?php echo $this->incidencia->fechaCreacionLetra; ?>
			</div>
			<div class="label">
				Categoría
			</div>
			<div class="value">
				<div class="badge badge-primary">
					<?php echo $this->incidencia->categoria; ?>
				</div>
			</div>
		</div>
		<h5 class="info-header">
			Agentes Asignados
		</h5>
		<div class="info-section">
			<ul class="users-list as-tiles">
			<?php 
				if ($this->usuarios) {
					foreach ($this->usuarios as $usuario) {
			?>
				<li>
					<a class="author with-avatar" href="#">
						<div class="avatar" style="background-image: url('<?php echo Config::get('URL'); ?>img/usuarios/avatar<?php echo $usuario->idUsuario; ?>.jpg');"></div>
						<span><?php echo $usuario->nombre; ?><br /><?php echo $usuario->apellidos; ?></span>
					</a>
				</li>
			<?php
					}
				}	
			?>
				<li>
					<a class="add-agent-btn ps-3 pe-3 pt-4 ld-accion-rapida-right right-bar-toggle" href="javascript: void(0);" data-href="<?php echo Config::get('URL'); ?>incidencias/nuevoUsuarioIncidencia/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>"><i class="os-icon os-icon-ui-22 mb-4"></i><span>Agregar Agente</span></a>
				</li>
			</ul>
		</div>
	</div>
<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Reportar Incidencia
	</h6>
	<div class="element-box-tp">
		<form name="agregarIncidencia" id="agregarIncidencia" novalidate method="post" class="needs-validation form form-horizontal">
			
		<?php
			if ($this->tipo == "Transaccion") {
				
				$transaccion = TerminalesModel::obtenerTransaccionTerminal($this->idTipo, $this->idComercio);
				
				if ($transaccion->reversata) {
					$color = "warning";
					$estatus = "Reversada";
					$totalReversada = $transaccion->monto;
				} elseif ($transaccion->aprobada) {
					$color = "success";
					$estatus = "Aprobada";
					$totalAprobada = $transaccion->monto;
				} elseif (!($transaccion->aprobada)) {
					$color = "danger";
					$estatus = "No Aprobada";
					$totalNoAprobada = $transaccion->monto;
				} else {
					$color = "warning";
					$estatus = "";
				}
				
		?>
			<div class="row">
				<div class="col-11 offset-md-1 mb-1">
					<h5 class="info-header text-primary">#<?php echo $this->idTipo; ?>-1</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mb-3">
					<div class="support-index">
						<div class="support-tickets" style="border-right: 0px; flex: 0 0 450px; margin-left: 20px;">
							<div class="support-ticket mb-3">
								<div class="st-meta">
									<div class="badge badge-<?php echo $color; ?> badge-pill">
										<?php if ($transaccion->reversada) echo "Reversada"; elseif ($transaccion->aprobada) echo "Aprobada"; else echo "No Aprobada"; ?>
									</div>
								</div>
								<div class="st-body">
									<div class="ticket-content">
										<h6 class="ticket-title">$ <?php echo number_format($transaccion->monto, 2, ".", ","); ?> <small class="text-muted ml-2"><?php echo Text::title($transaccion->marca); ?> - <?php echo $transaccion->tarjeta; ?></small>
										</h6>
										<div class="ticket-description">
											<small class="text-muted"><?php echo substr($transaccion->fecha, 0, 10); ?> <?php echo substr($transaccion->fecha, 11, 5); ?></small>
										</div>
									</div>
								</div>
								<div class="st-foot">
									<span class="label">Terminal:</span><span class="value"><?php echo $transaccion->idTerminal; ?></span>
								<?php
									 if ($transaccion->autorizacion) {
								?>
									<span class="label">Aut.:</span><span class="value"><?php echo $transaccion->autorizacion; ?></span>
								<?php
									 }
								?>
									<span class="label">Emisor:</span><span class="value"><?php echo substr($transaccion->emisor, 0, 15); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			}
		?>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group" id="categorias">
						<label for="nombre">Categoría</label><br />
					
				<?php
					if ($this->categorias) {
						foreach ($this->categorias as $categoria) {
				?>
						<a href="javascript: seleccionarCategoria(<?php echo $categoria->idCategoria; ?>);">
							<span class="badge badge-<?php echo $categoria->color; ?> mr-1" id="idCategoria<?php echo $categoria->idCategoria; ?>"><?php echo $categoria->categoria; ?></span>
						</a>
				<?php		
						}
					}	
				?>
						<input type="hidden" name="idCategoria" id="idCategoria" value="" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="incidencia">Incidencia *</label>
						<div class="input-group">
							<input name="incidencia" id="incidencia" class="form-control" placeholder="" type="text" value="" autocomplete="off" required />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<div class="input-group">
							<textarea name="descripcion" id="descripcion" class="form-control" autocomplete="off" rows="3"></textarea>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group" id="agentes">
						<label for="nombre">Agente</label><br />
					
				<?php
					if ($this->usuarios) {
						foreach ($this->usuarios as $usuario) {
				?>
						<a href="javascript: seleccionarAgente(<?php echo $usuario->idUsuario; ?>);">
							<span class="badge badge-primary mr-1" id="idAgente<?php echo $usuario->idUsuario; ?>"><?php echo $usuario->nombre . " " . substr($usuario->apellidos, 0, 1) . "."; ?></span>
						</a>
				<?php		
						}
					}	
				?>
						<input type="hidden" name="idUsuario" id="idUsuario" value="" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<input type="hidden" name="tipo" id="tipo" value="<?php echo $this->tipo; ?>" />
					<input type="hidden" name="idTipo" id="idTipo" value="<?php echo $this->idTipo; ?>" />
					<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-hash"></i><span>Reportar Incidencia</span></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#telefono, #monto").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
				return;
			}

			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		
		$("#agregarIncidencia").on("submit", (function(e) {
	
			e.preventDefault();
			
			var form = document.getElementById('agregarIncidencia');
			
			if (form.checkValidity() === false) {
				e.stopPropagation();
			} else {
				form.classList.add('was-validated');

				var formData = new FormData(this);

				$.ajax({
					url: url + "incidencias/agregarIncidencia",
					type: "POST",
					dataType: "JSON",
					data:  formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(result)
					{
						if (result.success) {
							$('#accion-rapida-right').html("");
							
							$toast = toastr["success"]("Incidencia creada con éxito");
							
							$('body').removeClass('right-bar-enabled');
						} else {
							$toast = toastr["error"](result.msg);
						}
					},
					error: function(e) 
					{
						$toast = toastr["error"](e);
					}          
				});
			}
			
		}));
	});
	
	function seleccionarAgente(idUsuario)
	{
		$('#idUsuario').val(idUsuario);
		$('#agentes .badge').removeClass('badge-success');
		$('#idAgente' + idUsuario).addClass('badge-success');
	}
	
	function seleccionarCategoria(idCategoria)
	{
		$('#idCategoria').val(idCategoria);
		$('#categorias .badge').removeClass('badge-success');
		$('#idCategoria' + idCategoria).addClass('badge-success');
	}
</script>
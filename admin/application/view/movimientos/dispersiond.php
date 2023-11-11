<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Dispersión Tarjetas
	</h6>
	<div class="element-box-tp">
		<form  novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for=idTarjeta"">Tarjeta *</label>
						<select name="idTarjeta" id="idTarjeta" class="form-control" required>
							<option value="">Seleccionar una opción</option>
					<?php
						if ($this->tarjetas && $this->idComercio == 1683) {
							foreach ($this->tarjetas as $tarjeta) {		
					?>
							<option value="<?php echo $tarjeta->idTarjeta; ?>">
								<?php echo $tarjeta->nombreCompleto; ?> - <?php echo substr($tarjeta->tarjeta, 4, 4); ?>
							</option>
					<?php
							}
						}
					?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for=accion"">Acción *</label>
						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
							<div class="btn-group" role="group" aria-label="First group">
								<button type="button" class="btn btn-primary m-0">Fondear</button>
								<button type="button" class="btn btn-primary m-0">Reversar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for="">Monto *</label>
						<div class="input-group">
							<input name="monto" id="monto" class="form-control" placeholder="" type="text" value="" required />
							<div class="input-group-append">
								<div class="input-group-text">
									MXN
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for="comentarios">Comentarios</label>
						<div class="input-group">
							<textarea name="comentarios" id="comentarios" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-10 offset-md-1">
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-refresh-ccw"></i><span>Transferir ahora</span></button>
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
	});
</script>
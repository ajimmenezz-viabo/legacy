<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Ref. Comercio
	</h6>
	<div class="element-box-tp">
		<form name="generarReferencia" id="generarReferencia" novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="monto">Monto *</label>
						<div class="input-group">
							<input name="monto" id="monto" class="form-control" placeholder="" type="text" value="" autocomplete="off" required />
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
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Nombre Completo *</label>
						<div class="input-group">
							<input name="nombre" id="nombre" class="form-control" placeholder="" type="text" value="" autocomplete="off" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Correo</label>
						<div class="input-group">
							<input name="correo" id="correo" class="form-control" placeholder="" type="text" value="" autocomplete="off" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Teléfono *</label>
						<div class="input-group">
							<input name="telefono" id="telefono" class="form-control" placeholder="" type="text" maxlength="10" value="" autocomplete="off" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-hash"></i><span>Generar referencia</span></button>
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
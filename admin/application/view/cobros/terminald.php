<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Terminal Virtual
	</h6>
	<div class="element-box-tp">
		<form novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
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
				<div class=" col-md-10 offset-md-1">
					<div class="form-floating mb-3">
						<label for="concepto">Concepto *</label>
						<input type="text" name="concepto" id="concepto" class="form-control" placeholder="" value="" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12  col-md-10 offset-md-1">
					<div class="form-floating mb-3">
						<label for="numeroTarjeta">Numero tarjeta *</label>
						<input type="text" name="numeroTarjeta" id="numeroTarjeta" class="form-control" placeholder="" maxlength="16" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 offset-md-1">
					<div class="row">
						<div class="col-4 col-md-4">
							<div class="form-floating mb-3">
								<label for="mes">Mes *</label>
								<input type="text" name="mes" id="mes" class="form-control" placeholder="" maxlength="2" autocomplete="off" required>
							</div>
						</div>
						<div class="col-4 col-md-4">
							<div class="form-floating mb-3">
								<label for="ano">Año *</label>
								<input type="text" name="ano" id="ano" class="form-control" placeholder="" maxlength="2" autocomplete="off" required>
							</div>
						</div>
						<div class="col-4 col-md-4">
							<div class="form-floating mb-3">
								<label for="cvv">CVV</label>
								<input type="text" name="cvv" id="cvv" class="form-control" placeholder="CVV" maxlength="3" autocomplete="off" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 offset-md-1">
					<div class="form-floating mb-3">
						<label for="tarjetahabiente">Tarjetahabiente *</label>
						<input type="text" name="tarjetahabiente" id="tarjetahabiente" class="form-control" placeholder="" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 offset-md-1">
					<div class="form-floating mb-3">
						<label for="correo">Correo electrónico *</label>
						<input type="email" name="correo" id="correo" class="form-control" placeholder="" value="" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 offset-md-1">
					<div class="form-floating mb-3">
						<label for="telefono">Teléfono *</label>
						<input type="text" name="telefono" id="telefono" class="form-control" placeholder="" value="" maxlength="10" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 offset-md-1">
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-grid-circles"></i><span>Procesar pago</span></button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#telefono, #monto, #numeroTarjeta, #mes, #ano, #cvv").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
				return;
			}

			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
	});
</script>
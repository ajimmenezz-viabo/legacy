<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Liga Pago
	</h6>
	<div class="element-box-tp">
		<form name="agregarCobro" id="agregarCobro" novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="monto">Monto *</label>
						<div class="input-group">
							<input name="monto" id="monto" class="form-control" placeholder="" type="text" value="" autocomplete="off" required  />
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
						<label for="nombreCompleto">Nombre completo *</label>
						<div class="input-group">
							<input name="nombreCompleto" id="nombreCompleto" class="form-control" placeholder="" type="text" value="" autocomplete="off" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Correo electrónico *</label>
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
					<div class="form-group">
						<label for="nombre">Mensaje</label>
						<div class="input-group">
							<textarea name="mensaje" id="mensaje" class="form-control" autocomplete="off" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-link"></i><span>Generar liga</span></button>
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
		
		$("#agregarCobro").on("submit", (function(e) {
	
			e.preventDefault();
			
			var form = document.getElementById('agregarCobro');
			
			if (form.checkValidity() === false) {
				e.stopPropagation();
			} else {
				form.classList.add('was-validated');

				var formData = new FormData(this);

				$.ajax({
					url: url + "cobros/agregarCobro",
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
							
							html = '<div class="element-wrapper">' + 
										'<div class="element-actions actions-only">' + 
										'</div>' + 
										'<h6 class="element-header">Liga Pago</h6>' + 
										'<div class="element-box-tp">' + 
											'<div class="row">' + 
												'<div class="col-md-10 offset-md-1 mt-4">' + 
													'<div class="form-group">' + 
														'<label for="liga">Copiar liga</label>' + 
														'<input type="text" name="liga" id="liga" class="form-control" value="https://www.viabo.com/admin/cobros/cliente/' + result.idCobro + '/' + result.codigoVerificacion + '" placeholder="" onfocus="javascript: this.select();" readonly />' + 
													'</div>' + 
												'</div>' + 
											'</div>' + 
										'</div>' +
									'</div>';
							
							$('#accion-rapida-right').html(html);
							
							$toast = toastr["success"]("Liga generada con éxito");
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
</script>
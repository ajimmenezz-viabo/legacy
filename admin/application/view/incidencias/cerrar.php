<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Cerrar Incidencia
	</h6>
	<div class="element-box-tp">
		<form name="terminarIncidencia" id="terminarIncidencia" novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="resolucion">Resolución *</label>
						<div class="input-group">
							<textarea name="resolucion" id="resolucion" class="form-control" autocomplete="off" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<input type="hidden" name="idIncidencia" id="idIncidencia" value="<?php echo $this->idIncidencia; ?>" />
					<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-check"></i><span>Cerrar incidencia</span></button>
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
		
		$("#terminarIncidencia").on("submit", (function(e) {
	
			e.preventDefault();
			
			var form = document.getElementById('terminarIncidencia');
			
			if (form.checkValidity() === false) {
				e.stopPropagation();
			} else {
				form.classList.add('was-validated');

				var formData = new FormData(this);

				$.ajax({
					url: url + "incidencias/terminarIncidencia",
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
							
							$toast = toastr["success"]("Incidencia carrada con éxito");
							
							$('#detalle-contenido-center').load(url + 'incidencias/detalleIncidencia/<?php echo $this->idIncidencia; ?>/<?php echo $this->idComercio; ?>');
							
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
</script>
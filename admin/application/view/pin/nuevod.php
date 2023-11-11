<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Agregar Pin
	</h6>
	<div class="element-box-tp">
		<form  novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Incidencia *</label>
						<div class="input-group">
							<input name="telefono" id="telefono" class="form-control" placeholder="" type="text" maxlength="10" value="" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="nombre">Descripción </label>
						<div class="input-group">
							<textarea name="mensaje" id="mensaje" class="form-control" rows="3"></textarea>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 offset-md-1">
					<div class="form-group">
						<label for="nombre">Agentes </label>
					</div>
				<?php
					if ($this->usuarios) {
						foreach ($this->usuarios as $usuario) {
				?>
						
				<?php		
						}
					}	
				?>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light">Aceptar</a>
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-hash"></i><span>Agregar Pin</span></button>
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

<form name="agregarPin" id="agregarPin" novalidate method="post" class="needs-validation form form-horizontal">
	<h5 class="modal-title mt-0" id="myModalLabel">Pin <?php echo Text::title($this->tipo); ?></h5>

	<div class="form">
		<div class="row">
			<div class="col-md-12 mt-4">
				<div class="form-floating mb-3">
					<textarea name="pin" id="pin" class="form-control" rows="4" placeholder="" style="height: 120px;"></textarea>
					<label for="pin">Pin *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-floating mb-3">
					<select name="idUsuarios[]" id="idUsuarios" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="..." style="">
				<?php
					if ($this->usuarios) {
						foreach ($this->usuarios as $usuario) {

							if ($usuario->idUsuario != Session::get('idUsuario')) {
				?>
						<option value="<?php echo $usuario->idUsuario; ?>"><?php echo $usuario->nombre; ?></option>
				<?php
							}
						}
					}
				?>
					</select>
					<label for="idUsuarios">Asesores</label>
				</div>
			</div>
		</div>
	</div>
	<br />

	
</form>


<script type="text/javascript">
	
	$(document).ready(function() {
		
		$(".select2").select2({
			dropdownParent: $("#accion-rapida")
		});
		
		$('.select2').click(function(e){
		   if($(this).find('select2-dropdown-open')) {
			  $(this).next('.head_ctrl_label').css('margin-top', '-25px'); }
			  e.preventDefault();
		});
		
		$("#agregarPin").on("submit",(function(e) {

			e.preventDefault();

			var formData = new FormData(this);
			
			$.ajax({
				url: url + "pins/ajaxAgregarPin",
				type: "POST",
				dataType: "JSON",
				data:  formData,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data)
				{
					if (data.success == 1) {
			
						if (data.tipo == "solicitud") {
							icono = "file";
							liga = url + "solicitudes/detalleSolicitud/" + data.idTipo;
						} else {
							if (data.tipo == "reservacion") {
								icono = "book";
								liga = url + "reservaciones/detalleReservacion/" + data.idTipo;
							} else {
								if (data.tipo == "servicio") {
									icono = "bookmark";
									liga = url + "servicios/detalleServicioReservacion/" + data.idTipo;
								}
							}
						}

						html = '<div class="alert alert-primary alert-dismissible fade show" role="alert">' + 
									'<a href="' + liga + '">' + 
										'<i class="bx bx-' + icono + ' me-2"></i> ' + data.idTipo.padStart(5, "0") + ' - ' + data.nombreCompleto +  
									'</a>' + 
									'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick="javascript: removerPin(' + data.idPin + ')"></button>' + 
								'</div>';
						
						$('#pins').prepend(html);
						$('body').toggleClass('right-bar-enabled');
					}

					$('#accion-rapida').html("");
				},
				error: function(e) 
				{
					alert(e);
				}          
			});
		}));
	});
	
</script>
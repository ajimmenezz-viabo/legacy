<form name="agregarTarea" id="agregarTarea" novalidate method="post" class="needs-validation form form-horizontal">

	<h5 class="modal-title mt-0" id="myModalLabel">Tarea <?php echo Text::title($this->tipo); ?></h5>

	<div class="row">
		<div class="col-md-8 offset-md-1 mt-4">
			<div class="form-floating mb-3">
				<textarea name="tarea" id="tarea" class="form-control" rows="4" placeholder="" style="height: 120px;"></textarea>
				<label for="tarea">Tarea *</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 offset-md-1 mt-4">
			<div class="form-floating mb-3">
				<textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="" style="height: 120px;"></textarea>
				<label for="descripcion">Descripción *</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 offset-md-1">
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
	<div class="row">
		<div class="col-md-8">
			<div class="form-floating mb-3" id="datepicker">
				<input type="text" name="fechaInicio" id="fechaInicio" class="datepicker form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>" required data-date-format=yyyy-mm-dd data-date-container='#datepicker' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" readonly>
				<label for="fechaInicio">Fecha Inicio *</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="form-floating mb-3" id="datepicker1">
				<input type="text" name="fechaTermino" id="fechaTermino" class="datepicker form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>" required data-date-format=yyyy-mm-dd data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" readonly>
				<label for="fechaTermino">Fecha Término *</label>
			</div>
		</div>
	</div>
	<br />
	<input type="hidden" name="tipo" id="tipo" value="<?php echo $this->tipo; ?>" />

	<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary waves-effect waves-light">Aceptar</a>
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
		
		$("#agregarTarea").on("submit",(function(e) {

			e.preventDefault();

			var formData = new FormData(this);
			
			$.ajax({
				url: url + "pins/ajaxAgregarTarea",
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

					$('#md-modal').modal('hide');
				},
				error: function(e) 
				{
					alert(e);
				}          
			});
		}));
	});
	
</script>
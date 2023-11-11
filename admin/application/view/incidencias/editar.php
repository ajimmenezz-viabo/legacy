<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Actualizar Incidencia
	</h6>
	<div class="element-box-tp">
		<form name="actualizarIncidencia" id="actualizarIncidencia" novalidate method="post" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-12 offset-md-1">
					<div class="form-group" id="categorias">
						<label for="nombre">Categoría</label><br />
					
				<?php
					if ($this->categorias) {
						foreach ($this->categorias as $categoria) {
				?>
						<a href="javascript: seleccionarCategoria(<?php echo $categoria->idCategoria; ?>);">
							<span class="badge badge-primary <?php if ($this->incidencia->idCategoria == $categoria->idCategoria) echo "badge-success"; ?> mr-1" id="idCategoria<?php echo $categoria->idCategoria; ?>"><?php echo $categoria->categoria; ?></span>
						</a>
				<?php		
						}
					}	
				?>
						<input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $this->incidencia->idCategoria; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="incidencia">Incidencia *</label>
						<div class="input-group">
							<input name="incidencia" id="incidencia" class="form-control" placeholder="" type="text" value="<?php echo $this->incidencia->incidencia; ?>" autocomplete="off" required />

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<div class="input-group">
							<textarea name="descripcion" id="descripcion" class="form-control" autocomplete="off" rows="3"><?php echo $this->incidencia->descripcion; ?></textarea>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 offset-md-1">
					<div class="form-group" id="agentes">
						<label for="nombre">Agente</label><br />
					
				<?php
					if ($this->usuarios) {
						foreach ($this->usuarios as $usuario) {
				?>
						<a href="javascript: seleccionarAgente(<?php echo $usuario->idUsuario; ?>);">
							<span class="badge badge-primary <?php if ($this->incidencia->idUsuario == $usuario->idUsuario) echo "badge-success"; ?> mr-1" id="idAgente<?php echo $usuario->idUsuario; ?>"><?php echo $usuario->nombre . " " . substr($usuario->apellidos, 0, 1) . "."; ?></span>
						</a>
				<?php		
						}
					}	
				?>
						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $this->incidencia->idUsuario; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<input type="hidden" name="tipo" id="tipo" value="<?php echo $this->incidencia->tipo; ?>" />
					<input type="hidden" name="idTipo" id="idTipo" value="<?php echo $this->incidencia->idTipo; ?>" />
					<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
					<input type="hidden" name="idIncidencia" id="idIncidencia" value="<?php echo $this->idIncidencia; ?>" />
					<button class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-hash"></i><span>Actualizar Incidencia</span></button>
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
		
		$("#actualizarIncidencia").on("submit", (function(e) {
	
			e.preventDefault();
			
			var form = document.getElementById('actualizarIncidencia');
			
			if (form.checkValidity() === false) {
				e.stopPropagation();
			} else {
				form.classList.add('was-validated');

				var formData = new FormData(this);

				$.ajax({
					url: url + "incidencias/actualizarIncidencia",
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
							
							$toast = toastr["success"]("Incidencia actualizada con éxito");
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
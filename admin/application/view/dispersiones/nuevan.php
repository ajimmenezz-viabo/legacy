<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Dispersión Tarjetas
	</h6>
	<div class="element-box-tp">
		<form name="agregarDispersion" id="agregarDispersion" novalidate method="post" class="needs-validation form form-horizontal">
			<?php
				$balance = ViaboModel::obtenerBalance($this->idTarjeta);
			?>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="element-box el-tablo centered trend-in-corner smaller">
						<div class="label">Disponible</div>
						<div class="value text-success">$<?php echo number_format($balance->Balance, 2, ".", ","); ?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for=idTarjetaDestino"">Tarjeta *</label>
						<select name="idTarjetaDestino" id="idTarjetaDestino" class="form-control" required>
							<option value="">Seleccionar una opción</option>
					<?php
						if ($this->tarjetas && $this->idComercio == 1683) {
							foreach ($this->tarjetas as $tarjeta) {		
								
								if ($tarjeta->idTarjeta != 1) {
					?>
							<option value="<?php echo $tarjeta->idTarjeta; ?>">
								<?php echo $tarjeta->nombreCompleto; ?> - <?php echo substr($tarjeta->tarjeta, 4, 4); ?>
							</option>
					<?php
								}
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
								<button type="button" class="btn btn-primary m-0" id="btnFondear" onClick="javascript: actualizarAccion('Fondear');">Fondear</button>
								<button type="button" class="btn btn-primary m-0" id="btnReversar" onClick="javascript: actualizarAccion('Reversar');">Reversar</button>
							</div>
						</div>
					</div>
					<input type="hidden" name="accion" id="accion" value="" />
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-10 offset-md-1">
					<div class="form-group">
						<label for="">Monto *</label>
						<div class="input-group">
							<input name="monto" id="monto" class="form-control" placeholder="" type="text" value="" required autocomplete="off" />
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
							<textarea name="comentarios" id="comentarios" class="form-control" rows="3" autocomplete="off"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<input type="hidden" name="idTarjetaOrigen" id="idTarjetaOrigen" value="1" />
					<input type="hidden" name="idComercio" id="idComercio" value="<?php echo $this->idComercio; ?>" />
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
		
		$("#agregarDispersion").on("submit", (function(e) {
	
			e.preventDefault();
			
			var form = document.getElementById('agregarDispersion');
			
			if (form.checkValidity() === false) {
				e.stopPropagation();
			} else {
				form.classList.add('was-validated');

				var formData = new FormData(this);

				$.ajax({
					url: url + "dispersiones/agregarDispersion",
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
							
							$toast = toastr["success"]("Dispersión realizada con éxito");
							
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
	
	function actualizarAccion(accion) {
		$('#btnFondear').removeClass('btn-success');
		$('#btnReversar').removeClass('btn-success');

		$('#btn' + accion).addClass('btn-success');

		$('#accion').val(accion);
	}
</script>
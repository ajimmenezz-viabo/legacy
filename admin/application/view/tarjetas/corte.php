<form name="agregarCorteTarjeta" id="agregarCorteTarjeta" novalidate method="post" action="<?php echo Config::get('URL'); ?>tarjetas/agregarCorteTarjeta" class="needs-validation form form-horizontal">
	<div class="modal-header">
		<h5 class="modal-title mt-0" id="myModalLabel">Corte Tarjeta</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-8 offset-md-1 mt-4">
				<div class="mb-4">
					<label for="comprobante" class="form-label">Tarjeta</label>
					<h5 class="text-muted"><?php echo $this->tarjeta->tarjeta . " - " . $this->tarjeta->ultimosDigitos; ?></h5>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 offset-md-1">
				<div class="form-floating mb-3">
					<input type="text" name="pagoMinimo" id="pagoMinimo" class="form-control" placeholder="" required>
					<label for="pagoMinimo">Pago mínimo *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-1">
				<div class="form-floating mb-3">
					<input type="text" name="pagoNoIntereses" id="pagoNoIntereses" class="form-control" placeholder="" required>
					<label for="pagoNoIntereses">Pago no intereses *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-1">
				<div class="form-floating mb-3">
					<input type="text" name="pagoTotal" id="pagoTotal" class="form-control" placeholder="" required>
					<label for="pagoTotal">Pago Total *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-1">
				<div class="form-floating mb-3">
					<input type="text" name="saldo" id="saldo" class="form-control" placeholder="" required>
					<label for="saldo">Saldo *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-1">
				<div class="form-floating mb-3" id="datepicker2">
					<input type="text" name="fecha" id="fecha" class="datepicker form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>" required data-date-format=yyyy-mm-dd data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" readonly>
					<label for="fecha">Fecha *</label>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="idTarjeta" id="idTarjeta" value="<?php echo $this->idTarjeta; ?>" />
		<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-primary waves-effect waves-light">Agregar</button>
	</div>
</form>

<script type="text/javascript">
	
	$(document).ready(function() {
		$(".select2").select2({
			dropdownParent: $("#md-modal")
		});
		
		 $('.select2').click(function(e){
		   if($(this).find('select2-dropdown-open')) {
			  $(this).next('.head_ctrl_label').css('margin-top', '-25px'); }
			  e.preventDefault();
		});
		
	});	
	
</script>
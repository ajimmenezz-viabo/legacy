<div class="element-wrapper">
	<div class="element-actions actions-only">
		
	</div>
	<h6 class="element-header">
		Autentificación 2-Factores
	</h6>
	<div class="element-box-tp">
		<form name="sincronizarTransaccionesCuentas" id="sincronizarTransaccionesCuentas" novalidate method="post" action="<?php echo Config::get('URL'); ?>sincronizaciones/sincronizarTransaccionesCuentas" class="needs-validation form form-horizontal">
			<div class="row">
				<div class="col-10 offset-md-1">
					<div class="form-group">
						<label for="token">Token *</label>
						<input type="password" name="token" id="token" class="form-control" autocomplete="off" required />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-10 offset-md-1">
					<button type="submit" class="btn btn-primary btn-block btn-md"><i class="os-icon os-icon-refresh-cw"></i><span>Sincronizar cuenta</span></button>
				</div>
			</div>
		</form>
	</div>
</div>

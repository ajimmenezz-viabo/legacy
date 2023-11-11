<div class="content-i" style="min-height: 950px;">
    <div class="content-box">
        <div class="support-index">
            <div class="support-tickets">
                <div class="support-tickets-header">
                    <div class="tickets-control">
                        <h5>
                            Comercios
                        </h5>
                    </div>
                </div>
				<div id="comercios-dinamicas">
		<?php		
			if ($this->comercios) {
				foreach ($this->comercios as $comercio) {
		?>
					<a href="javascript: void(0);" class="list-comercios-dinamicas ld-detalle-archivo mb-3" data-href="#">
						<div class="support-ticket mb-3 <?php if ($comercio->idComercio == $this->idComercio) echo "active"; ?>">
							<div class="st-meta">
								<?php
									if ($balance->Status == "Unblocked" || $balance->Status == "UnBlocked") echo "<i class=\"bx bx-lock-open text-success\"></i>";
									elseif ($balance->Status == "Blocked") echo "<i class=\"bx bx-lock text-danger\"></i>";
								?>
							</div>
							<div class="st-body">
								<div class="ticket-content">
									<h6 class="ticket-title"><?php echo Text::title($comercio->comercio); ?> 
									</h6>
									<div class="ticket-description">
										<small class="text-muted"><?php echo substr($comercio->Date, 0, 16); ?></small>
									</div>
								</div>
							</div>
							<div class="st-foot">
								<span class="label">Disponible:</span><span class="value">$<?php echo number_format($balance->Balance, 2, ".", ","); ?></span>
							</div>
						</div>
					</a>
		<?php
				}
			}		
		?>		</div>
                <div class="load-more-tickets">
                    <!--<a href="#"><span>Cargar más incidencias</span></a>-->
                </div>
            </div>
            <div class="support-ticket-content-w">
                <div class="support-ticket-content">
					<div id="detalle-archivo">
						
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Tareas</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tareas</a></li>
                                    <li class="breadcrumb-item active">Tareas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php $this->renderFeedbackMessages(); ?>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Pendientes <?php if (sizeof($this->pendientes) > 0) { ?><span class="badge rounded-pill badge-soft-warning font-size-11"><?php echo sizeof($this->pendientes); ?></span><?php } ?></h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
									<?php
										if ($this->pendientes) {
											foreach ($this->pendientes as $tarea) {
									?>
											<tr>
                                                <td style="width: 40px;">
                                                    <div class="form-check font-size-16">
                                                        <input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
                                                        <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark"><?php echo $tarea->tarea; ?></a></h5>
                                                </td>
                                                <td>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <span class="badge rounded-pill badge-soft-secondary font-size-11"><?php echo $tarea->estatus; ?></span>
                                                    </div>
                                                </td>
                                            </tr>
									<?php
											}
										}
									?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">En Proceso <?php if (sizeof($this->proceso) > 0) { ?><span class="badge rounded-pill badge-soft-warning font-size-11"><?php echo sizeof($this->proceso); ?></span><?php } ?></h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                    <?php
										if ($this->proceso) {
											foreach ($this->proceso as $tarea) {
									?>
											<tr>
                                                <td style="width: 40px;">
                                                    <div class="form-check font-size-16">
                                                        <input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
                                                        <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark"><?php echo $tarea->tarea; ?></a></h5>
                                                </td>
                                                <td>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <span class="badge rounded-pill badge-soft-secondary font-size-11"><?php echo $tarea->estatus; ?></span>
                                                    </div>
                                                </td>
                                            </tr>
									<?php
											}
										}
									?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
					
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Tareas</h4>

                                <div id="task-chart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Tareas Recientes</h4>

                                <div class="table-responsive mb-3">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
									<?php
										if ($this->recientes) {
											foreach ($this->recientes as $tarea) {
									?>			
											<tr>
                                                <td>
                                                    <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark"><?php echo $tarea->tarea; ?></a></h5>
                                                </td>
                                                <td>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="<?php echo Config::get('URL'); ?>assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
									<?php
											}
										}		
									?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
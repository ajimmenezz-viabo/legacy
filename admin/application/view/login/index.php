<!DOCTYPE html>
<html>
    <head>
        <title>Acceso Admin - Viabo</title>
        <meta charset="utf-8" />
        <meta content="ie=edge" http-equiv="x-ua-compatible" />
        <meta content="template language" name="keywords" />
        <meta content="Tamerlan Soziev" name="author" />
        <meta content="Admin dashboard html template" name="description" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link href="favicon.png" rel="shortcut icon" />
        <link href="apple-touch-icon.png" rel="apple-touch-icon" />
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/dropzone/dist/dropzone.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet" />
        <link href="<?php echo Config::get('URL'); ?>bower_components/slick-carousel/slick/slick.css" rel="stylesheet" />
		<link href="<?php echo Config::get('URL'); ?>bower_components/zabuto-calendar/zabuto_calendar.min.css" rel="stylesheet" />
		<link href="<?php echo Config::get('URL'); ?>bower_components/toastr/build/toastr.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo Config::get('URL'); ?>css/main.css?<?php echo time(); ?>" rel="stylesheet" />
		
		
    </head>
    <body class="auth-wrapper">
        <div class="all-wrapper menu-side">
            <div class="auth-box-w">
                <div class="logo-w">
                    <a href="index.html"><img alt="" src="<?php echo Config::get('URL'); ?>img/logo-big.png" /></a>
                </div>
                <h4 class="auth-header">
                    Acceso usuarios
                </h4>
                
                <form class="form-horizontal" method="post" action="<?php echo Config::get('URL'); ?>login/iniciarSesion">
					<div class="form-group">
						<?php $this->renderFeedbackMessages(); ?>
					</div>
                    <div class="form-group">
                        <label for="">Usuario</label><input name="usuario" id="usuario" class="form-control" placeholder="Ingresar usuario" type="text" />
                        <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label><input name="contrasena" id="contrasena" class="form-control" placeholder="Ingresar Contraseña" type="password" />
                        <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    </div>
                    <div class="buttons-w">
                        <button class="btn btn-primary">Iniciar sesión</button>
                        <div class="form-check-inline">
                            <label class="form-check-label"><input class="form-check-input" type="checkbox" />Recordarme</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		
		
        <script src="<?php echo Config::get('URL'); ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/moment/moment.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/chart.js/dist/Chart.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap-validator/dist/validator.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/dropzone/dist/dropzone.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/editable-table/mindmup-editabletable.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/tether/dist/js/tether.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/slick-carousel/slick/slick.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/util.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/alert.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/button.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/carousel.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/collapse.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/dropdown.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/modal.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/tab.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/tooltip.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/bootstrap/js/dist/popover.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/jquery.number/jquery.number.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/toastr/build/toastr.min.js"></script>
        <script src="<?php echo Config::get('URL'); ?>bower_components/isotope/isotope.min.js"></script>
		<script type="text/javascript">
			var url = '<?php echo Config::get('URL'); ?>'; 
		</script>

        <script src="<?php echo Config::get('URL'); ?>js/main.js?<?php echo time(); ?>"></script>
    </body>
</html>

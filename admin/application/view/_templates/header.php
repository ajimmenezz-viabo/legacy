<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Viabo</title>
        <meta charset="utf-8" />
        <meta content="ie=edge" http-equiv="x-ua-compatible" />
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
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
		<script>0</script>
        <div class="all-wrapper with-side-panel solid-bg-all">
            <div class="layout-w">
                <div class="menu-mobile menu-activated-on-click color-scheme-light">
                    <div class="mm-logo-buttons-w">
                        <a class="mm-logo" href="<?php echo Config::get('URL'); ?>"><img src="<?php echo Config::get('URL'); ?>img/logo.png" /></a>
                        <div class="mm-buttons">
                            <div class="content-panel-open">
                                <div class="os-icon os-icon-grid-circles"></div>
                            </div>
                            <div class="mobile-menu-trigger">
                                <div class="os-icon os-icon-hamburger-menu-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-and-user">
                        <div class="logged-user-w">
                            <div class="avatar-w bg-primary p-2">
                                <?php echo Session::get('inicialesUsuario'); ?>
                            </div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name">
                                    <?php echo Session::get('nombreUsuario'); ?>
                                </div>
                                <div class="logged-user-role text-dark">
                                    <?php echo Session::get('perfilUsuario'); ?>
                                </div>
                            </div>
                        </div>
						
                        <ul class="main-menu">
							
							<li class="">
								<a href="<?php echo Config::get('URL'); ?>tablero">
									<div class="icon-w">
										<div class="os-icon os-icon-layout"></div>
									</div>
									<span>Tablero</span>
								</a>
							</li>
						<?php
							if (Session::get('perfilUsuario') == "Super Administrador") {	
						?>
							<li class="">
								<a href="<?php echo Config::get('URL'); ?>comercios">
									<div class="icon-w">
										<div class="os-icon os-icon-layers"></div>
									</div>
									<span>Comercios</span>
								</a>
							</li>
						<?php
							}
						?>
							<li class="">
								<a href="<?php echo Config::get('URL'); ?>incidencias">
									<div class="icon-w">
										<div class="os-icon os-icon-life-buoy"></div>
									</div>
									<span>Incidencias</span>
								</a>
							</li>
							<li class="">
								<a href="<?php echo Config::get('URL'); ?>afiliaciones">
									<div class="icon-w">
										<div class="os-icon os-icon-file-text"></div>
									</div>
									<span>Afiliaciones</span>
								</a>
							</li>
							<li class="">
								<a href="<?php echo Config::get('URL'); ?>reportes">
									<div class="icon-w">
										<div class="os-icon os-icon-pie-chart-1"></div>
									</div>
									<span>Reportes</span>
								</a>
							</li>
                        </ul> 
                    </div>
                </div>          
				<div class="menu-w color-scheme-light color-style-default menu-position-side menu-side-left menu-layout-mini sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
                    <div class="logo-w">
                        <a class="logo text-center" href="<?php echo Config::get('URL'); ?>">
                            <img src="<?php echo Config::get('URL'); ?>img/logo.png"  />
                        </a>
                    </div>
                    <h1 class="menu-page-header">
                        Menú
                    </h1>
                    <ul class="main-menu">
                        <li class="has-sub-menu">
                            <a href="<?php echo Config::get('URL'); ?>tablero">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layout"></div>
                                </div>
                                <span>Tablero</span>
                            </a>
							<div class="sub-menu-w">
                                <div class="sub-menu-header">
                                    Tablero
                                </div>
							</div>
                        </li>
					<?php
						if (Session::get('perfilUsuario') == "Super Administrador") {	
					?>
                        <li class="has-sub-menu">
                            <a href="<?php echo Config::get('URL'); ?>comercios">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layers"></div>
                                </div>
                                <span>Comercios</span>
                            </a>
							<div class="sub-menu-w">
                                <div class="sub-menu-header">
                                    Comercios
                                </div>
							</div>
                        </li>
					<?php
						}
						
						if (Session::get('perfilUsuario') == "Super Administrador") {	
							
					?>
                        <li class="has-sub-menu">
                            <a href="<?php echo Config::get('URL'); ?>incidencias">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-life-buoy"></div>
                                </div>
                                <span>Incidencias</span>
                            </a>
							<div class="sub-menu-w">
                                <div class="sub-menu-header">
                                    Incidencias
                                </div>
							</div>
                        </li>
                        <li class="has-sub-menu">
                            <a href="<?php echo Config::get('URL'); ?>afiliaciones">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-file-text"></div>
                                </div>
                                <span>Afiliaciones</span>
                            </a>
							<div class="sub-menu-w">
                                <div class="sub-menu-header">
                                    Afiliaciones
                                </div>
							</div>
                        </li>
					<?php
						}
					?>
                        <li class="has-sub-menu">
                            <a href="<?php echo Config::get('URL'); ?>reportes/comisiones">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-percent"></div>
                                </div>
                                <span>Reportes</span>
                            </a>
							<div class="sub-menu-w">
                                <div class="sub-menu-header">
                                    Reportes
                                </div>
							</div>
                        </li>
                    </ul>
                </div>
				
                <div class="content-w">
                    <div class="top-bar color-scheme-transparent">
						<div class="fancy-selector-w">
                            <div class="fancy-selector-current">
                               <!-- 
								<div class="fs-img">
                                    <img alt="" src="<?php echo Config::get('URL'); ?>img/card4.png" />
                                </div>
								-->
                                <div class="fs-main-info pl-4 pr-4">
								<?php
									if (Session::get('idComercio')) {
										$comercio = ComerciosModel::obtenerComercio(Session::get('idComercio'));
										$comercio = $comercio->comercio;
									} else {
										$comercio = "ITRAVELMX";
									}
								?>
                                    <div class="fs-name" id="lblComercio"><span><?php echo $comercio; ?></span></div>
                                    <div class="fs-sub"></div>
                                </div>
							<?php
								if (Session::get('perfilUsuario') == "Super Administrador") {	
							?>
                                <div class="fs-selector-trigger">
                                    <i class="os-icon os-icon-arrow-down4"></i>
                                </div>
							<?php
								}
							?>	
                            </div>
						<?php
							if (Session::get('perfilUsuario') == "Super Administrador") {	
						?>
                            <div class="fancy-selector-options" style="max-height: 490px; overflow-y: scroll; -ms-overflow-style: none; scrollbar-width: none;">
							<?php
								$comercios = ViaboModel::obtenerComercios();
								
								if ($comercios) {
									foreach ($comercios as $comercio) {
							?>
								<a href="javascript: void(0);" onclick="javascript: actualizarComercio(<?php echo $comercio->id; ?>, 'tablero');">    
									<div class="fancy-selector-option <?php if ($this->idComercio == $comercio->id) echo "active"; ?>">
										<div class="fs-img">
											<!--<img alt="" src="<?php echo Config::get('URL'); ?>img/card2.png" />-->
										</div>
										<div class="fs-main-info">
											<div class="fs-name"><span><?php echo $comercio->tradename; ?></span></div>
											<div class="fs-sub"></div>
										</div>
									</div>
								</a>
							<?php
									}
								}
							?>
                                <div class="fancy-selector-actions text-right">
                                    <a class="btn btn-dark" href="#"><i class="os-icon os-icon-ui-22"></i><span>Agregar Comercio</span></a>
                                </div>
                            </div>
						<?php
							}
						?>
                        </div>
						
                        <div class="top-menu-controls d-none d-md-flex">
                            <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                                <i class="os-icon os-icon-mail-14"></i>
                            </div>
                            <div class="logged-user-w">
                                <div class="logged-user-i">
                                    <div class="avatar-w bg-primary p-2">
                                        <?php echo Session::get('inicialesUsuario'); ?>
                                    </div>
                                    <div class="logged-user-menu color-style-bright">
                                        <div class="logged-user-avatar-info">
                                            <div class="avatar-w bg-primary p-2">
                                                 <?php echo Session::get('inicialesUsuario'); ?>
                                            </div>
                                            <div class="logged-user-info-w">
                                                <div class="logged-user-name">
                                                    <?php echo Session::get('nombreUsuario'); ?>
                                                </div>
                                                <div class="logged-user-role text-dark">
                                                    <?php echo Session::get('perfilUsuario'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <ul>
                                            <li class="text-nowrap">
                                                <a href="<?php echo Config::get('URL'); ?>login/cerrarSesion"><i class="os-icon os-icon-signs-11"></i><span>Cerrar Sesión</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
						
					<!--<div id="widget"></div>-->
					<div class="content-i">
						
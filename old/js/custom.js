jQuery(document).ready(function($) {
    'use strict';

	var $window   = $(window),
        $document = $(document),
        $body     = $('body');

    window.SITE = {

        // Initialization
        init: function() {
            var self = this,
                obj;

            for ( obj in self ) {
                if ( self.hasOwnProperty(obj) ) {
                    var _method = self[obj];
                    if ( _method.selector !== undefined && _method.init !== undefined ) {
                        if ( $(_method.selector).length > 0 ) {
                            _method.init();
                        }
                    }
                }
            }
        },
		
		serviciosCarousel: {
			selector: '#servicios-carousel',
			init: function () {
				
				$('#servicios-carousel').owlCarousel({
					loop: true,
					margin: 0,
					autoplay: true,
					autoplayTimeout: 5000,
					responsiveClass: true,
					dots: false,
					responsive:{
						0:{
							items: 1,
							nav: false,
							dots: false
						},
						600:{
							items: 2,
							nav: false,
							dots: false
						},
						1000:{
							items: 4,
							nav: false,
						},
						1200:{
							items: 5,
							nav: false,
						},
						1440:{
							items: 5,
							nav: false,
						}

					}
				});
				
			}	
		},
		
        contactForm: {
            selector: '#contact-form',
            init: function() {
        
                var self = $('#contact-form');
            
                self.validate({
                    /*errorElement: 'span',
                    errorLabelContainer: self.find('.form-error'),*/
                    wrapper: "p",
                    rules: {
                        nombre: {
                            required    : true,
                            minlength   : 2
                        },
                        correo: {
                            required    : true,
                            email       : true
                        },
                        whatsapp: {
                            required    : true,
                            minlength   : 8
                        }
                    },
                    messages: {
                        nombre: {
                            required    : "Por favor ingresa tu nombre.",
                            minlength   : "El nombre debe contenter por lo menos 2 caracteres"
                        },
                        correo: {
                            required    : "Por favor ingresa tu correo.",
                            minlength   : "El correo ingresado es invalido."
                        },
                        whatsapp: {
                            required    : "Por favor ingresa tu WhatsApp o celular.",
                            minlength   : "El WhatsApp o celular debe contenter por lo menos 8 digitos"
                        }
                    }
                });
            
                self.submit(function() {
                    var $formAlert = $(this).find('.form-alert');
                    var $loader    = $(this).find('.ajax-loader');
                    var response;
                    $formAlert.hide().html();
                    $loader.show();
                    if (self.valid()){
                        $.ajax({
                            type: "POST",
                            url: "php/contact-form.php",
                            data: $(this).serialize(),
                            success: function(msg) {
                                if (msg === 'SEND') {
									
									if ($('#registrado').val() == 0) {
										$('#basico').hide();
										$('#personalizado').fadeIn(500);
										$('#registrado').val(1);
									} else {
										$('#personalizado').hide();
										$('#finalizar').fadeIn(500);
									}
                                }
                                else {
                                    response = '<div class="alert alert-danger">Uuups... parece que tenemos un problema.</div>';
									$formAlert.html(response);
                                	$formAlert.show();
                                }
                                $loader.hide();
                            }
                        });
                        return false;
                    }
                    $loader.hide();
                    return false;
                });
        
            },
        },
	};
	
	$document.ready(function() {
		window.SITE.init();	
	});
});
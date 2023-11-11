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
			
			new WOW().init();
        },
		
		navigation: {
            selector: '.links',
            init: function() {
				
                $('.links').on('click', function(e) {
                    e.preventDefault();
                    $body.toggleClass('nav-open');
                });
        
                $('.menu-dropdown > a').on('click', function(e) {
                    e.preventDefault();
                    if ($(this).next('ul').is(':visible')) {
                        $(this).next('ul').slideUp(250);
                    } else {
                        $(this).closest('ul').find('ul').slideUp(250);
                        $(this).next('ul').slideDown(250);
                    }
                });
        
            }
        },
	};
	
	$document.ready(function() {
		window.SITE.init();	

		$('.patrocinadores-carousel').owlCarousel({
            loop: true,
            margin: 200,
            nav: false,
            navText: [
                '<i class="bx bx-chevron-left"></i>',
                '<i class="bx bx-chevron-right"></i>'
            ],
            dots: false,
            autoWidth: false,
            autoplay: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
            responsive: {
                0: {
					margin: 10,
                    items: 2
                },
                480: {
					margin: 10,
                    items: 2
                },
                667: {
					margin: 10,
                    items: 2
                },
                768: {
					margin: 80,
                    items: 3
                },
                1024: {
					margin: 150,
                    items: 3
                },
                1200: {
					margin: 80,
                    items: 4
                },
                1441: {
					margin: 200,
                    items: 4
                }
            }
        });
		
		$('.instagram-carousel').owlCarousel({
            loop: true,
            margin: 1,
            nav: false,
            navText: [
                '<i class="bx bx-chevron-left"></i>',
                '<i class="bx bx-chevron-right"></i>'
            ],
            dots: false,
            autoWidth: false,
            autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 2
                },
                667: {
                    items: 3
                },
                768: {
                    items: 4
                },
                1024: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });
		
		$('.testimoniales-carousel').owlCarousel({
            loop: true,
            margin: 60,
            nav: false,
            navText: [
                '<i class="bx bx-chevron-left"></i>',
                '<i class="bx bx-chevron-right"></i>'
            ],
            dots: false,
            autoWidth: false,
            autoplay: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                667: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1024: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1441: {
                    items: 3
                }
            }
        });
	});
	
// Example starter JavaScript for disabling form submissions if there are invalid fields

});

(function() {
  'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					event.preventDefault();
					habilitarNavegacion();
					mostrarPaso(1);
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();
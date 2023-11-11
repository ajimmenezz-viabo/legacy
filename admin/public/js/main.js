"use strict";

// ------------------------------------
// HELPER FUNCTIONS TO TEST FOR SPECIFIC DISPLAY SIZE (RESPONSIVE HELPERS)
// ------------------------------------

function is_display_type(display_type) {
  return $('.display-type').css('content') == display_type || $('.display-type').css('content') == '"' + display_type + '"';
}

function not_display_type(display_type) {
  return $('.display-type').css('content') != display_type && $('.display-type').css('content') != '"' + display_type + '"';
} // Initiate on click and on hover sub menu activation logic


function os_init_sub_menus() {
  // INIT MENU TO ACTIVATE ON HOVER
  var menu_timer;
  $('.menu-activated-on-hover').on('mouseenter', 'ul.main-menu > li.has-sub-menu', function () {
    var $elem = $(this);
    clearTimeout(menu_timer);
    $elem.closest('ul').addClass('has-active').find('> li').removeClass('active');
    $elem.addClass('active');
  });
  $('.menu-activated-on-hover').on('mouseleave', 'ul.main-menu > li.has-sub-menu', function () {
    var $elem = $(this);
    menu_timer = setTimeout(function () {
      $elem.removeClass('active').closest('ul').removeClass('has-active');
    }, 30);
  }); // INIT MENU TO ACTIVATE ON CLICK

  $('.menu-activated-on-click').on('click', 'li.has-sub-menu > a', function (event) {
    var $elem = $(this).closest('li');

    if ($elem.hasClass('active')) {
      $elem.removeClass('active');
    } else {
      $elem.closest('ul').find('li.active').removeClass('active');
      $elem.addClass('active');
    }

    return false;
  });
}

$(function () {
	
	/*
	 * Conciliaciones
	 */
	var $toast = "";
	
	$("#conciliarTransacciones").on("submit", (function(e) {

		e.preventDefault();

		var form = document.getElementById('conciliarTransacciones');

		if (form.checkValidity() === false) {
			e.stopPropagation();
		} else {
			form.classList.add('was-validated');

			var formData = new FormData(this);

			$.ajax({
				url: url + "conciliaciones/conciliarTransacciones",
				type: "POST",
				dataType: "JSON",
				data:  formData,
				contentType: false,
				cache: false,
				processData: false,
				success: function(result)
				{
					if (result.success) {
						$.each(result.idTransaccionesTerminal, function(index, item) {
							$('#transaccionTerminal' + item).remove();
						});

						$('#transaccionCuenta' + result.idTransaccionCuenta).remove();
						
						$('#lblTotalTransaccionesTerminal').html('$' + $.number(0, 2) + ' <small>MXN</small>');
						$('#totalTransaccionesTerminal').val(parseFloat(0));
						
						$('#lblTotalTransaccionesCuenta').html('$' + $.number(0, 2) + ' <small>MXN</small>');
						$('#totalTransaccionesCuenta').val(parseFloat(0));
						
						$('#btn-conciliar').removeClass('btn-success');
						$('#btn-conciliar').addClass('btn-primary');
						
						$toast = toastr["success"]("Transacciones conciliadas con éxito");
						
						$('#accion-rapida-right').html("");
							
						$('body').toggleClass('right-bar-enabled');

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
	
	$('body').delegate('.right-bar-toggle', 'click',  function() {
		$('body').toggleClass('right-bar-enabled');
	});

	$('body').delegate(document, 'click',  function(e) {
		if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
			return;
		}

		$('body').removeClass('right-bar-enabled');
		return;
	});
	
	$('body').delegate('.ld-detalle-contenido-center', 'click',  function() {
		$('#detalle-contenido-center').load($(this).data('href'), function(e) {
			var forms = document.getElementsByClassName('needs-validation');

			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
			
			$('.close-ticket-info').on('click', function () {
				$('.support-ticket-content-w').addClass('folded-info').removeClass('force-show-folded-info');
				return false;
			});
			
			$('.show-ticket-info').on('click', function () {
				$('.support-ticket-content-w').removeClass('folded-info').addClass('force-show-folded-info');
				return false;
			});
		});
	});
	
	$('body').delegate('.ld-accion-rapida-right', 'click',  function() {
		$('#accion-rapida-right').load($(this).data('href'), function(e) {
			var forms = document.getElementsByClassName('needs-validation');

			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
			
		});
	});
	
	/*
	 * Filtros
	 */
	/*
	var $grid = $('#transacciones-dinamicas').isotope({
		columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
		itemSelector: '.list-transacciones-dinamicas'
	});
	
	$grid.imagesLoaded(function() {
		$grid.isotope("layout");
	});
	
	var filters = {};

	$('.filtros').on( 'click', '.filtrar', function() {
		var $this = $(this);
		var $buttonGroup = $this.parents('.filtrar-grupo');
		var filterGroup = $buttonGroup.attr('data-filter-group');
	
		filters[ filterGroup ] = $this.attr('data-filter');
		
		var filterValue = concatValues(filters);
		$grid.isotope({ filter: filterValue });
	});

	function concatValues(obj) {
		var value = '';
		for (var prop in obj) {
			value += obj[ prop ];
		}
		return value;
	}
	*/
	
/*	
 * #1. CHAT APP
  $('.floated-chat-btn, .floated-chat-w .chat-close').on('click', function () {
    $('.floated-chat-w').toggleClass('active');
    return false;
  });
  $('.message-input').on('keypress', function (e) {
    if (e.which == 13) {
      $('.chat-messages').append('<div class="message self"><div class="message-content">' + $(this).val() + '</div></div>');
      $(this).val('');
      var $messages_w = $('.floated-chat-w .chat-messages');
      $messages_w.scrollTop($messages_w.prop("scrollHeight"));
      $messages_w.perfectScrollbar('update');
      return false;
    }
  });
  $('.floated-chat-w .chat-messages').perfectScrollbar(); 
*/
	
  
/*
 * #2. CALENDAR INIT
  if ($("#fullCalendar").length) {
    var calendar, d, date, m, y;
    date = new Date();
    d = date.getDate();
    m = date.getMonth();
    y = date.getFullYear();
    calendar = $("#fullCalendar").fullCalendar({
      header: {
        left: "prev,next today",
        center: "title",
        right: "month,agendaWeek,agendaDay"
      },
      selectable: true,
      selectHelper: true,
      select: function select(start, end, allDay) {
        var title;
        title = prompt("Event Title:");

        if (title) {
          calendar.fullCalendar("renderEvent", {
            title: title,
            start: start,
            end: end,
            allDay: allDay
          }, true);
        }

        return calendar.fullCalendar("unselect");
      },
      editable: true,
      events: [{
        title: "Long Event",
        start: new Date(y, m, 3, 12, 0),
        end: new Date(y, m, 7, 14, 0)
      }, {
        title: "Lunch",
        start: new Date(y, m, d, 12, 0),
        end: new Date(y, m, d + 2, 14, 0),
        allDay: false
      }, {
        title: "Click for Google",
        start: new Date(y, m, 28),
        end: new Date(y, m, 29),
        url: "http://google.com/"
      }]
    });
  }
*/ 
  // #3. FORM VALIDATION

/*
  if ($('#formValidate').length) {
    $('#formValidate').validator();
  } 
*/	
 
  // #4. DATE RANGE PICKER
  $('input.single-daterange').daterangepicker({
    "singleDatePicker": true,
    locale: {
      format: 'YYYY-MM-DD'
    }
  });
  $('input.multi-daterange').daterangepicker({
    "startDate": "03/28/2022",
    "endDate": "04/06/2022"
  }); // #5. DATATABLES

  if ($('#formValidate').length) {
    $('#formValidate').validator();
  }

  if ($('#dataTable1').length) {
    $('#dataTable1').DataTable({
      buttons: ['copy', 'excel', 'pdf']
    });
  } 
	
  // #6. EDITABLE TABLES
/*	
  if ($('#editableTable').length) {
    $('#editableTable').editableTableWidget();
  } // #7. FORM STEPS FUNCTIONALITY
*/

  $('.step-trigger-btn').on('click', function () {
    var btn_href = $(this).attr('href');
    $('.step-trigger[href="' + btn_href + '"]').click();
    return false;
  }); // FORM STEP CLICK

  $('.step-trigger').on('click', function () {
    var prev_trigger = $(this).prev('.step-trigger');
    if (prev_trigger.length && !prev_trigger.hasClass('active') && !prev_trigger.hasClass('complete')) return false;
    var content_id = $(this).attr('href');
    $(this).closest('.step-triggers').find('.step-trigger').removeClass('active');
    $(this).prev('.step-trigger').addClass('complete');
    $(this).addClass('active');
    $('.step-content').removeClass('active');
    $('.step-content' + content_id).addClass('active');
    return false;
  }); // END STEPS FUNCTIONALITY
  // #8. SELECT 2 ACTIVATION

  if ($('.select2').length) {
    $('.select2').select2();
  } // #9. CKEDITOR ACTIVATION

/*
  if ($('#ckeditor1').length) {
    CKEDITOR.replace('ckeditor1');
  } // #10. CHARTJS CHARTS http://www.chartjs.org/
*/

/*	
  if (typeof Chart !== 'undefined') {
    var fontFamily = '"Proxima Nova W01", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif'; // set defaults

    Chart.defaults.global.defaultFontFamily = fontFamily;
    Chart.defaults.global.tooltips.titleFontSize = 14;
    Chart.defaults.global.tooltips.titleMarginBottom = 4;
    Chart.defaults.global.tooltips.displayColors = false;
    Chart.defaults.global.tooltips.bodyFontSize = 12;
    Chart.defaults.global.tooltips.xPadding = 10;
    Chart.defaults.global.tooltips.yPadding = 8; // init lite line chart if element exists

    if ($("#liteLineChart").length) {
      var liteLineChart = $("#liteLineChart");
      var liteLineGradient = liteLineChart[0].getContext('2d').createLinearGradient(0, 0, 0, 200);
      liteLineGradient.addColorStop(0, 'rgba(30,22,170,0.08)');
      liteLineGradient.addColorStop(1, 'rgba(30,22,170,0)');
      var chartData = [13, 28, 19, 24, 43, 49];
      if (liteLineChart.data('chart-data')) chartData = liteLineChart.data('chart-data').split(','); // line chart data

      var liteLineData = {
        labels: ["January 1", "January 5", "January 10", "January 15", "January 20", "January 25"],
        datasets: [{
          label: "Sold",
          fill: true,
          lineTension: 0.4,
          backgroundColor: liteLineGradient,
          borderColor: "#8f1cad",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#fff",
          pointBackgroundColor: "#2a2f37",
          pointBorderWidth: 2,
          pointHoverRadius: 6,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 2,
          pointRadius: 4,
          pointHitRadius: 5,
          data: chartData,
          spanGaps: false
        }]
      }; // line chart init

      var myLiteLineChart = new Chart(liteLineChart, {
        type: 'line',
        data: liteLineData,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: false,
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    } // init lite line chart V2 if element exists


    if ($("#liteLineChartV2").length) {
      var liteLineChartV2 = $("#liteLineChartV2");
      var liteLineGradientV2 = liteLineChartV2[0].getContext('2d').createLinearGradient(0, 0, 0, 100);
      liteLineGradientV2.addColorStop(0, 'rgba(40,97,245,0.1)');
      liteLineGradientV2.addColorStop(1, 'rgba(40,97,245,0)');
      var chartDataV2 = [13, 28, 19, 24, 43, 49, 40, 35, 42, 46];
      if (liteLineChartV2.data('chart-data')) chartDataV2 = liteLineChartV2.data('chart-data').split(','); // line chart data

      var liteLineDataV2 = {
        labels: ["1", "3", "6", "9", "12", "15", "18", "21", "24", "27"],
        datasets: [{
          label: "Balance",
          fill: true,
          lineTension: 0.35,
          backgroundColor: liteLineGradientV2,
          borderColor: "#2861f5",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 2,
          pointRadius: 3,
          pointHitRadius: 10,
          data: chartDataV2,
          spanGaps: false
        }]
      }; // line chart init

      var myLiteLineChartV2 = new Chart(liteLineChartV2, {
        type: 'line',
        data: liteLineDataV2,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '10',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    } // init lite line chart V2 if element exists


    if ($("#liteLineChartV3").length) {
      var liteLineChartV3 = $("#liteLineChartV3");
      var liteLineGradientV3 = liteLineChartV3[0].getContext('2d').createLinearGradient(0, 0, 0, 70);
      liteLineGradientV3.addColorStop(0, 'rgba(40,97,245,0.2)');
      liteLineGradientV3.addColorStop(1, 'rgba(40,97,245,0)');
      var chartDataV3 = [13, 28, 19, 24, 43, 49, 40, 35, 42, 46, 38];
      if (liteLineChartV3.data('chart-data')) chartDataV3 = liteLineChartV3.data('chart-data').split(','); // line chart data

      var liteLineDataV3 = {
        labels: ["", "FEB", "", "MAR", "", "APR", "", "MAY", "", "JUN", "", "JUL", ""],
        datasets: [{
          label: "Balance",
          fill: true,
          lineTension: 0.15,
          backgroundColor: liteLineGradientV3,
          borderColor: "#2861f5",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 0,
          pointRadius: 0,
          pointHitRadius: 10,
          data: chartDataV3,
          spanGaps: false
        }]
      }; // line chart init

      var myLiteLineChartV3 = new Chart(liteLineChartV3, {
        type: 'line',
        data: liteLineDataV3,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '10',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    } // init line chart if element exists


    if ($("#lineChart").length) {
      var lineChart = $("#lineChart"); // line chart data

      var lineData = {
        labels: ["1", "5", "10", "15", "20", "25", "30", "35"],
        datasets: [{
          label: "Visitors Graph",
          fill: false,
          lineTension: 0.3,
          backgroundColor: "#fff",
          borderColor: "#047bf8",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#fff",
          pointBackgroundColor: "#141E41",
          pointBorderWidth: 3,
          pointHoverRadius: 10,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 3,
          pointRadius: 5,
          pointHitRadius: 10,
          data: [27, 20, 44, 24, 29, 22, 43, 52],
          spanGaps: false
        }]
      }; // line chart init

      var myLineChart = new Chart(lineChart, {
        type: 'line',
        data: lineData,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: 'rgba(0,0,0,0.05)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 65
              }
            }]
          }
        }
      });
    } // init donut chart if element exists


    if ($("#barChart1").length) {
      var barChart1 = $("#barChart1");
      var barData1 = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
          label: "My First dataset",
          backgroundColor: ["#5797FC", "#629FFF", "#6BA4FE", "#74AAFF", "#7AAEFF", '#85B4FF'],
          borderColor: ['rgba(255,99,132,0)', 'rgba(54, 162, 235, 0)', 'rgba(255, 206, 86, 0)', 'rgba(75, 192, 192, 0)', 'rgba(153, 102, 255, 0)', 'rgba(255, 159, 64, 0)'],
          borderWidth: 1,
          data: [24, 42, 18, 34, 56, 28]
        }]
      }; // -----------------
      // init bar chart
      // -----------------

      new Chart(barChart1, {
        type: 'bar',
        data: barData1,
        options: {
          scales: {
            xAxes: [{
              display: false,
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: 'rgba(0,0,0,0.05)'
              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: '#6896f9'
              }
            }]
          },
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          }
        }
      });
    } // init pie chart if element exists


    if ($("#pieChart1").length) {
      var pieChart1 = $("#pieChart1"); // pie chart data

      var pieData1 = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 0
        }]
      }; // -----------------
      // init pie chart
      // -----------------

      new Chart(pieChart1, {
        type: 'pie',
        data: pieData1,
        options: {
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 15,
              fontColor: '#3e4b5b'
            }
          },
          animation: {
            animateScale: true
          }
        }
      });
    } // -----------------
    // init donut chart if element exists
    // -----------------


    if ($("#donutChart").length) {
      var donutChart = $("#donutChart"); // donut chart data

      var data = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 0
        }]
      }; // -----------------
      // init donut chart
      // -----------------

      new Chart(donutChart, {
        type: 'doughnut',
        data: data,
        options: {
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          },
          cutoutPercentage: 80
        }
      });
    } // -----------------
    // init donut chart if element exists
    // -----------------


    if ($("#donutChart1").length) {
      var donutChart1 = $("#donutChart1"); // donut chart data

      var data1 = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 6,
          hoverBorderColor: 'transparent'
        }]
      }; // -----------------
      // init donut chart
      // -----------------

      new Chart(donutChart1, {
        type: 'doughnut',
        data: data1,
        options: {
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          },
          cutoutPercentage: 80
        }
      });
    }
  } 
*/	

  // #11. MENU RELATED STUFF
  // INIT MOBILE MENU TRIGGER BUTTON

$('.collapse').collapse({
  toggle: false
})

  $('.mobile-menu-trigger').on('click', function () {
    $('.menu-mobile .menu-and-user').slideToggle(200, 'swing');
    return false;
  });
  os_init_sub_menus(); // #12. CONTENT SIDE PANEL TOGGLER

  $('.content-panel-toggler, .content-panel-close, .content-panel-open').on('click', function () {
    $('.all-wrapper').toggleClass('content-panel-active');
  }); // #13. EMAIL APP 

  $('.more-messages').on('click', function () {
    $(this).hide();
    $('.older-pack').slideDown(100);
    $('.aec-full-message-w.show-pack').removeClass('show-pack');
    return false;
  });
  $('.ae-list').perfectScrollbar({
    wheelPropagation: true
  });
  $('.ae-list .ae-item').on('click', function () {
    $('.ae-item.active').removeClass('active');
    $(this).addClass('active');
    return false;
  }); // CKEDITOR ACTIVATION FOR MAIL REPLY

  if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.disableAutoInline = true;

    if ($('#ckeditorEmail').length) {
      CKEDITOR.config.uiColor = '#ffffff';
      CKEDITOR.config.toolbar = [['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'About']];
      CKEDITOR.config.height = 110;
      CKEDITOR.replace('ckeditor1');
    }
  } // EMAIL SIDEBAR MENU TOGGLER


  $('.ae-side-menu-toggler').on('click', function () {
    $('.app-email-w').toggleClass('compact-side-menu');
  }); // EMAIL MOBILE SHOW MESSAGE

  $('.ae-item').on('click', function () {
    $('.app-email-w').addClass('forse-show-content');
  });

  if ($('.app-email-w').length) {
    if (is_display_type('phone') || is_display_type('tablet')) {
      $('.app-email-w').addClass('compact-side-menu');
    }
  } // #14. FULL CHAT APP


  function add_full_chat_message($input) {
    $('.chat-content').append('<div class="chat-message self"><div class="chat-message-content-w"><div class="chat-message-content">' + $input.val() + '</div></div><div class="chat-message-date">1:23pm</div><div class="chat-message-avatar"><img alt="" src="img/avatar1.jpg"></div></div>');
    $input.val('');
    var $messages_w = $('.chat-content-w');
    $messages_w.scrollTop($messages_w[0].scrollHeight);
  }

  $('.chat-btn a').on('click', function () {
    add_full_chat_message($('.chat-input input'));
    return false;
  });
  $('.chat-input input').on('keypress', function (e) {
    if (e.which == 13) {
      add_full_chat_message($(this));
      return false;
    }
  }); // #15. CRM PIPELINE

  if ($('.pipeline').length) {
    // INIT DRAG AND DROP FOR PIPELINE ITEMS
    var dragulaObj = dragula($('.pipeline-body').toArray(), {}).on('drag', function () {}).on('drop', function (el) {}).on('over', function (el, container) {
      $(container).closest('.pipeline-body').addClass('over');
    }).on('out', function (el, container, source) {
      var new_pipeline_body = $(container).closest('.pipeline-body');
      new_pipeline_body.removeClass('over');
      var old_pipeline_body = $(source).closest('.pipeline-body');
    });
  } // #16. OUR OWN CUSTOM DROPDOWNS 


  $('.os-dropdown-trigger').on('mouseenter', function () {
    $(this).addClass('over');
  });
  $('.os-dropdown-trigger').on('mouseleave', function () {
    $(this).removeClass('over');
  }); // #17. BOOTSTRAP RELATED JS ACTIVATIONS
  // - Activate tooltips

  $('[data-toggle="tooltip"]').tooltip(); // - Activate popovers

  $('[data-toggle="popover"]').popover(); // #18. TODO Application
  // Tasks foldable trigger

  $('.tasks-header-toggler').on('click', function () {
    $(this).closest('.tasks-section').find('.tasks-list-w').slideToggle(100);
    return false;
  }); // Sidebar Sections foldable trigger

  $('.todo-sidebar-section-toggle').on('click', function () {
    $(this).closest('.todo-sidebar-section').find('.todo-sidebar-section-contents').slideToggle(100);
    return false;
  }); // Sidebar Sub Sections foldable trigger

  $('.todo-sidebar-section-sub-section-toggler').on('click', function () {
    $(this).closest('.todo-sidebar-section-sub-section').find('.todo-sidebar-section-sub-section-content').slideToggle(100);
    return false;
  }); // Drag init

  if ($('.tasks-list').length) {
    // INIT DRAG AND DROP FOR Todo Tasks
    var dragulaTasksObj = dragula($('.tasks-list').toArray(), {
      moves: function moves(el, container, handle) {
        return handle.classList.contains('drag-handle');
      }
    }).on('drag', function () {}).on('drop', function (el) {}).on('over', function (el, container) {
      $(container).closest('.tasks-list').addClass('over');
    }).on('out', function (el, container, source) {
      var new_pipeline_body = $(container).closest('.tasks-list');
      new_pipeline_body.removeClass('over');
      var old_pipeline_body = $(source).closest('.tasks-list');
    });
  } // Task actions init
  // Complete/Done


  $('.task-btn-done').on('click', function () {
    $(this).closest('.draggable-task').toggleClass('complete');
    return false;
  }); // Favorite/star

  $('.task-btn-star').on('click', function () {
    $(this).closest('.draggable-task').toggleClass('favorite');
    return false;
  }); // Delete

  var timeoutDeleteTask;
  $('.task-btn-delete').on('click', function () {
    if (confirm('Are you sure you want to delete this task?')) {
      var $task_to_remove = $(this).closest('.draggable-task');
      $task_to_remove.addClass('pre-removed');
      $task_to_remove.append('<a href="#" class="task-btn-undelete">Undo Delete</a>');
      timeoutDeleteTask = setTimeout(function () {
        $task_to_remove.slideUp(300, function () {
          $(this).remove();
        });
      }, 5000);
    }

    return false;
  });
  $('.tasks-list').on('click', '.task-btn-undelete', function () {
    $(this).closest('.draggable-task').removeClass('pre-removed');
    $(this).remove();

    if (typeof timeoutDeleteTask !== 'undefined') {
      clearTimeout(timeoutDeleteTask);
    }

    return false;
  }); // #19. Fancy Selector

  $('.fs-selector-trigger').on('click', function () {
    $(this).closest('.fancy-selector-w').toggleClass('opened');
  }); // #20. SUPPORT SERVICE

  $('.close-ticket-info').on('click', function () {
    $('.support-ticket-content-w').addClass('folded-info').removeClass('force-show-folded-info');
    return false;
  });
  $('.show-ticket-info').on('click', function () {
    $('.support-ticket-content-w').removeClass('folded-info').addClass('force-show-folded-info');
    return false;
  });
  $('.support-index .back-to-index').on('click', function () {
    $('.support-index').removeClass('show-ticket-content');
    return false;
  }); // #21. Onboarding Screens Modal

  $('.onboarding-modal.show-on-load').modal('show');

  if ($('.onboarding-modal .onboarding-slider-w').length) {
    $('.onboarding-modal .onboarding-slider-w').slick({
      dots: true,
      infinite: false,
      adaptiveHeight: true,
      slidesToShow: 1,
      slidesToScroll: 1
    });
    $('.onboarding-modal').on('shown.bs.modal', function (e) {
      $('.onboarding-modal .onboarding-slider-w').slick('setPosition');
    });
  } // #22. Colors Toggler


  $('.floated-colors-btn').on('click', function () {
    if ($('body').hasClass('color-scheme-dark')) {
      $('.menu-w').removeClass('color-scheme-dark').addClass('color-scheme-light').removeClass('selected-menu-color-bright').addClass('selected-menu-color-light');
      $(this).find('.os-toggler-w').removeClass('on');
    } else {
      $('.menu-w, .top-bar').removeClass(function (index, className) {
        return (className.match(/(^|\s)color-scheme-\S+/g) || []).join(' ');
      });
      $('.menu-w').removeClass(function (index, className) {
        return (className.match(/(^|\s)color-style-\S+/g) || []).join(' ');
      });
      $('.menu-w').addClass('color-scheme-dark').addClass('color-style-transparent').removeClass('selected-menu-color-light').addClass('selected-menu-color-bright');
      $('.top-bar').addClass('color-scheme-transparent');
      $(this).find('.os-toggler-w').addClass('on');
    }

    $('body').toggleClass('color-scheme-dark');
    return false;
  }); // #23. Autosuggest Search

  $('.autosuggest-search-activator').on('click', function () {
    var search_offset = $(this).offset(); // If input field is in the activator - show on top of it

    if ($(this).find('input[type="text"]')) {
      search_offset = $(this).find('input[type="text"]').offset();
    }

    var search_field_position_left = search_offset.left;
    var search_field_position_top = search_offset.top;
    $('.search-with-suggestions-w').css('left', search_field_position_left).css('top', search_field_position_top).addClass('over-search-field').fadeIn(300).find('.search-suggest-input').focus();
    return false;
  });
  $('.search-suggest-input').on('keydown', function (e) {
    // Close if ESC was pressed
    if (e.which == 27) {
      $('.search-with-suggestions-w').fadeOut();
    } // Backspace/Delete pressed


    if (e.which == 46 || e.which == 8) {
      // This is a test code, remove when in real life usage
      $('.search-with-suggestions-w .ssg-item:last-child').show();
      $('.search-with-suggestions-w .ssg-items.ssg-items-blocks').show();
      $('.ssg-nothing-found').hide();
    } // Imitate item removal on search, test code


    if (e.which != 27 && e.which != 8 && e.which != 46) {
      // This is a test code, remove when in real life usage
      $('.search-with-suggestions-w .ssg-item:last-child').hide();
      $('.search-with-suggestions-w .ssg-items.ssg-items-blocks').hide();
      $('.ssg-nothing-found').show();
    }
  });
  $('.close-search-suggestions').on('click', function () {
    $('.search-with-suggestions-w').fadeOut();
    return false;
  }); // #24. Element Actions

  $('.element-action-fold').on('click', function () {
    var $wrapper = $(this).closest('.element-wrapper');
    $wrapper.find('.element-box-tp, .element-box').toggle(0);
    var $icon = $(this).find('i');

    if ($wrapper.hasClass('folded')) {
      $icon.removeClass('os-icon-plus-circle').addClass('os-icon-minus-circle');
      $wrapper.removeClass('folded');
    } else {
      $icon.removeClass('os-icon-minus-circle').addClass('os-icon-plus-circle');
      $wrapper.addClass('folded');
    }

    return false;
  });
	
});

//# sourceMappingURL=main.js.map

/*
function filtrarTransacciones() {
	var idComercio = $('#idComercio').val();
	var idTerminal = $('#idTerminal option:selected').val();
	var dias = $('#dias option:selected').val();
	
	var html = "";
	var color = "";
	var estatus = "";
	
	dias = parseInt(dias);
	
	if (dias != 0) {
		
		var fechaTermino = new Date();

		fechaTermino.setDate(fechaTermino.getDate());
		// fechaInicio = Date.parse(fechaInicio);

		var month = '' + (fechaTermino.getMonth() + 1),
			day = '' + fechaTermino.getDate(),
			year = fechaTermino.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaTermino = [year, month, day].join('-');

		var arrayFechaTermino = fechaTermino.split('-'); 

		var fechaInicio = new Date(arrayFechaTermino[0], arrayFechaTermino[1]-1, arrayFechaTermino[2]);

		fechaInicio.setDate(fechaInicio.getDate() - dias);
		// fechaInicio = Date.parse(fechaInicio);

		month = '' + (fechaInicio.getMonth() + 1);
		day = '' + fechaInicio.getDate();
		year = fechaInicio.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaInicio = [year, month, day].join('-');
	} else {
		fechaInicio = "2022-09-01";
		fechaTermino = "2022-09-30";
	}
	
	var transacciones = $.ajax({
		url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + fechaInicio + "/" + fechaTermino,
		dataType: "json",
		global: false,
		async: false,
		success: function(result) {
			return result;
		}
	}).responseText;

	if (dias != 0) {
		html = '<h6 class="font-size-14 ms-3 mb-1">Últimos ' + dias + ' días</h6>';
	} else {
		
		html = '<h6 class="font-size-14 ms-3 mb-1">Mes Actual</h6>';
	}
	
		html +=	'<div class="row">' +
					'<div class="col-md-12 mt-2 mb-3 filtros">' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'visa\');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'master-card\');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'amex\');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'aprobada\');"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'no-aprobada\');"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'reversada\');"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>' +
					'</div>' +
				'</div>';
	
	$.each(JSON.parse(transacciones), function(index, item) {

		color = "";
		estatus = "";

		if (item.reversed) {
			color = "warning";
			estatus = "Reversada";
			totalReversada = item.amount;
		} else {
			if (item.approved) {
				color = "success";
				estatus = "Aprobada";
				totalAprobada = item.amount;
			} else {
				color = "danger";
				estatus = "No Aprobada";
				totalNoAprobada = item.amount;
			}
		}

		html += '<a href="javascript: void(0);" class="ld-detalle-archivo mb-3" data-href="' + url + 'transacciones/detalleTransaccionDinamica/' + item.id + '">' +
					'<div class="support-ticket mb-3">' +
						'<div class="st-meta">' +
							'<div class="badge badge-' + color + ' badge-pill">' +
								estatus +
							'</div>' +
						'</div>' +
						'<div class="st-body">' +
							'<div class="ticket-content">' +
								'<h6 class="ticket-title">$ ' + $.number(item.amount, 2) + ' <small class="text-muted ml-2">' + item.card_brand + ' - ' + item.card_number + '</small>' +
								'</h6>' +
								'<div class="ticket-description"><small class="text-muted">' + item.transaction_date.substr(0, 10) + ' ' + item.transaction_date.substr(11, 5) + '</small></div>' +
							'</div>' +
						'</div>' +
						'<div class="st-foot">' +
							'<span class="label">Terminal:</span><span class="value">' + item.terminal_id + '</span>';
			if (item.authorization_number != "") {
				html += 	'<span class="label">Aut.:</span><span class="value">' + item.authorization_number + '</span>';
			}

			html += 		'<span class="label">Emisor:</span><span class="value">' + item.issuer.substr(0, 15) + '</span>' +
						'</div>' +
					'</div>';
				'</a>';
		
			totalTransacciones += item.amount;
	});

	$("#transacciones-dinamicas").html(html);

	return false;
		
}

function filtrarTransaccionesFecha(){
	var idComercio = $('#idComercio').val();
	var idTerminal = $('#idTerminal option:selected').val();	
	var fechaInicio = $('#fechaInicio').val();
	var fechaTermino = $('#fechaTermino').val();

	var html = "";
	var color = "";
	var estatus = "";
	
	var transacciones = $.ajax({
		url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + fechaInicio + "/" + fechaTermino,
		dataType: "json",
		global: false,
		async: false,
		success: function(result) {
			return result;
		}
	}).responseText;


	html = '<h6 class="font-size-14 ms-3 mb-1">Del ' + fechaInicio + ' al ' + fechaTermino + '</h6>' +
			'<div class="row">' +
			'<div class="col-md-12 mt-2 mb-3 filtros">' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'visa\');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'master-card\');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'amex\');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'aprobada\');"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'no-aprobada\');"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>' +
				'<a href="javascript: filtrarLocal(\'transacciones-dinamicas\', \'reversada\');"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>' +
			'</div>' +
		'</div>';

	$.each(JSON.parse(transacciones), function(index, item) {

		color = "";
		estatus = "";

		if (item.reversed) {
			color = "warning";
			estatus = "Reversada"
		} else {
			if (item.approved) {
				color = "success";
				estatus = "Aprobada"
			} else {
				color = "danger";
				estatus = "No Aprobada";
			}
		}

		html += '<a href="javascript: void(0);" class="ld-detalle-archivo mb-3" data-href="' + url + 'transacciones/detalleTransaccionDinamica/' + item.id + '">' +
					'<div class="support-ticket mb-3">' +
						'<div class="st-meta">' +
							'<div class="badge badge-' + color + ' badge-pill">' +
								estatus +
							'</div>' +
						'</div>' +
						'<div class="st-body">' +
							'<div class="ticket-content">' +
								'<h6 class="ticket-title">$ ' + $.number(item.amount, 2) + ' <small class="text-muted ml-2">' + item.card_brand + ' - ' + item.card_number + '</small>' +
								'</h6>' +
								'<div class="ticket-description"><small class="text-muted">' + item.transaction_date.substr(0, 10) + ' ' + item.transaction_date.substr(11, 5) + '</small></div>' +
							'</div>' +
						'</div>' +
						'<div class="st-foot">' +
							'<span class="label">Terminal:</span><span class="value">' + item.terminal_id + '</span>';
			if (item.authorization_number != "") {
				html += 	'<span class="label">Aut.:</span><span class="value">' + item.authorization_number + '</span>';
			}

			html += 		'<span class="label">Emisor:</span><span class="value">' + item.issuer.substr(0, 15) + '</span>' +
						'</div>' +
					'</div>';
				'</a>';
	});

	$("#transacciones-dinamicas").html(html);

	return false;
}
*/

function activarIncidencia(idIncidencia) {
	$('#incidencias-dinamicas .incidencia-item ').removeClass('active');
	$('#incidencia' + idIncidencia).addClass('active');
}

function filtrarTransacciones() {
	var idComercio = $('#idComercio').val();
	var idTerminal = $('#idTerminal option:selected').val();
	var dias = $('#dias option:selected').val();
	
	var html = "";
	var color = "";
	var estatus = "";
	var tipos = ["Crédito", "Débito", "Cargos"];
	
	dias = parseInt(dias);
	
	if (dias != 0) {
		
		var fechaTermino = new Date();

		fechaTermino.setDate(fechaTermino.getDate());
		// fechaInicio = Date.parse(fechaInicio);

		var month = '' + (fechaTermino.getMonth() + 1),
			day = '' + fechaTermino.getDate(),
			year = fechaTermino.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaTermino = [year, month, day].join('-');

		var arrayFechaTermino = fechaTermino.split('-'); 

		var fechaInicio = new Date(arrayFechaTermino[0], arrayFechaTermino[1]-1, arrayFechaTermino[2]);

		fechaInicio.setDate(fechaInicio.getDate() - dias);
		// fechaInicio = Date.parse(fechaInicio);

		month = '' + (fechaInicio.getMonth() + 1);
		day = '' + fechaInicio.getDate();
		year = fechaInicio.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaInicio = [year, month, day].join('-');
	} else {
		fechaInicio = "2022-10-01";
		fechaTermino = "2022-10-30";
	}
	
	var transacciones = $.ajax({
		url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + fechaInicio + "/" + fechaTermino,
		dataType: "json",
		global: false,
		async: false,
		success: function(result) {
			return result;
		}
	}).responseText;
/*
	if (dias != 0) {
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - ' + dias +  ' dias' +
			   '</h6>';
	} else {
		
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - Mes actual' +
			   '</h6>';
	}
*/	
	
	html +=	'<table class="table table-striped">' +
				'<thead>' +
					'<tr>' +
						'<th></th>' +
						'<th>Fecha</th>' +
						'<th>Tarjeta</th>' +
						'<th>Tipo</th>' +
						'<th>Importe</th>' +
						'<th>Estatus</th>' +
						'<th></th>' +
					'</tr>' +
				'</thead>';
	
	var totalEgresos = 0;
	var totalIngresos = 0;
	var totalVisaEgresos = 0;
	var totalMasterCardEgresos = 0;
	var totalAmexEgresos = 0;
	var totalAprobadaEgresos = 0;
	var totalNoAprobadaEgresos = 0;
	var totalReversadaEgresos = 0;
	
	var totalVisaIngresos = 0;
	var totalMasterCardIngresos = 0;
	var totalAmexIngresos = 0;
	var totalAprobadaIngresos = 0;
	var totalNoAprobadaIngresos = 0;
	var totalReversadaIngresos = 0;
	var comision = 0.00

	$.each(JSON.parse(transacciones), function(index, item) {

		color = "";
		estatus = "";
		comision = 0.00;
		
		if (item.reversed) {
			color = "warning";
			estatus = "Reversada";
			totalReversadaEgresos += parseFloat(item.amount);
		} else {
			if (item.approved) {
				color = "success";
				estatus = "Aprobada";
				
				if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "0") {
					comision = 0.0178;
					
					if (item.card_brand == "VISA") { 
						totalVisaIngresos += parseFloat(item.amount);
						totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
					} else {
						if (item.card_brand == "MASTER CARD") { 
							totalMasterCardIngresos += parseFloat(item.amount);
							totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						}
					}
				}else {
					if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "1") {
						comision = 0.014;
						
						if (item.card_brand == "VISA") { 
							totalVisaIngresos += parseFloat(item.amount);
							totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						} else {
							if (item.card_brand == "MASTER CARD") { 
								totalMasterCardIngresos += parseFloat(item.amount);
								totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
							}
						}
						
						
					}else {
						if (item.card_brand == "AMEX") {
							comision = 0.027;
							
							totalAmexIngresos += parseFloat(item.amount);
							totalAmexEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						}
					}
				}
				
				totalAprobadaIngresos += parseFloat(item.amount);
				totalAprobadaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
				
				totalIngresos += parseFloat(item.amount);
				totalEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
			} else {
				color = "danger";
				estatus = "No Aprobada";
				// totalNoAprobadaIngresos += parseFloat(item.amount);
			}
		}

		html += '<tr class="list-transacciones-dinamicas ' + item.card_brand.toLowerCase().replace(" ", "-") + ' ' + estatus.toLowerCase().replace(" ", "-") + '">' +
					'<td><input type="checkbox" name="idTransaccionCheck' + item.id + '" id="idTransaccionCheck' + item.id + '" value="' + item.id + '" /></td>' +
					'<td nowrap>' + item.transaction_date.substr(0, 10) + ' ' + item.transaction_date.substr(11, 5) + '</td>' +
					'<td>' + item.card_brand + ' - ' + item.card_number + '</td>' +
					'<td>' + tipos[item.card_type] + '</td>' +
					'<td class="text-right"><strong>$' + $.number(item.amount, 2) + '</strong></td>' +
					'<td class="text-center">' +
						'<span class="badge badge-pill badge-' + color + '">' + estatus + '</span>' +
					'</td>' +
					'<td>' +
						'<button aria-expanded="false" aria-haspopup="true" class="btn btn-white dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" type="button"><span class="sr-only">Toggle Dropdown</span></button>' +
						'<div class="dropdown-menu" style="">' +
							'<a class="dropdown-item ld-accion-rapida-right" href="javascript: void(0);" data-href="' + url + 'incidencias/nuevaIncidencia/' + item.id + '"> Incidencia</a>' +
							'<a class="dropdown-item ld-accion-rapida-right" href="javascript: void(0);" data-href="' + url + 'pins/nuevoPin/Transaccion/' + item.id + '"> Pin</a>' +
							'<a class="dropdown-item ld-accion-rapida-right" href="javascript: void(0);" data-href="' + url + 'transacciones/comprobanteTransaccion/' + item.id + '"> Comprobante</a>' +
						'</div>' +
					'</td>' +
				'</tr>';
	});
	
	html +=		'<tfoot>' +
					'<tr>' +
						'<td colspan="4"></td>' +
						'<td class="text-right"><strong>$<span id="lblTotalIngresos1"> ' + $.number(totalIngresos, 2) + '</span></strong></td>' +
						'<td></td>' +
						'<td></td>' +
					'</tr>' +
				'</tfoot>' +
			'</table>' +
			'<input type="hidden" name="totalVisaIngresos" id="totalVisaIngresos" value="' + totalVisaIngresos + '" />' +
			'<input type="hidden" name="totalMasterCardIngresos" id="totalMasterCardIngresos" value="' + totalMasterCardIngresos + '" />' +
			'<input type="hidden" name="totalAmexIngresos" id="totalAmexIngresos" value="' + totalAmexIngresos + '" />' +
			'<input type="hidden" name="totalAprobadaIngresos" id="totalAprobadaIngresos" value="' + totalAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaIngresos" id="totalNoAprobadaIngresos" value="' + totalNoAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalReversadaIngresos" id="totalReversadaIngresos" value="' + totalReversadaIngresos + '" />' +
			'<input type="hidden" name="totalVisaEgresos" id="totalVisaEgresos" value="' + totalVisaEgresos + '" />' +
			'<input type="hidden" name="totalMasterCardEgresos" id="totalMasterCardEgresos" value="' + totalMasterCardEgresos + '" />' +
			'<input type="hidden" name="totalAmexEgresos" id="totalAmexEgresos" value="' + totalAmexEgresos + '" />' +
			'<input type="hidden" name="totalAprobadaEgresos" id="totalAprobadaEgresos" value="' + totalAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaEgresos" id="totalNoAprobadaEgresos" value="' + totalNoAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalReversadaEgresos" id="totalReversadaEgresos" value="' + totalReversadaEgresos + '" />' +
			'<input type="hidden" name="totalEgresos" id="totalEgresos" value="' + totalEgresos + '" />' +
			'<input type="hidden" name="totalIngresos" id="totalIngresos" value="' + totalIngresos + '" />';

	$("#transacciones-dinamicas").html(html);
	$('#lblTotalIngresos').html($.number(totalIngresos, 2));
	$('#lblTotalEgresos').html($.number(totalEgresos, 2));

	return false;
}

function filtrarTransaccionesFecha() {
	var idComercio = $('#idComercio').val();
	var idTerminal = $('#idTerminal option:selected').val();	
	var fechaInicio = $('#fechaInicio').val();
	var fechaTermino = $('#fechaTermino').val();

	var html = "";
	var color = "";
	var estatus = "";
	var tipos = ["Crédito", "Débito", "Cargos"];
	
	dias = parseInt(dias);
	
	var transacciones = $.ajax({
		url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + fechaInicio + "/" + fechaTermino,
		dataType: "json",
		global: false,
		async: false,
		success: function(result) {
			return result;
		}
	}).responseText;
/*
	if (dias != 0) {
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - ' + dias +  ' dias' +
			   '</h6>';
	} else {
		
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - Mes actual' +
			   '</h6>';
	}
*/	
	
	html +=	'<table class="table table-striped">' +
				'<thead>' +
					'<tr>' +
						'<th></th>' +
						'<th>Fecha</th>' +
						'<th>Tarjeta</th>' +
						'<th>Tipo</th>' +
						'<th>Importe</th>' +
						'<th>Estatus</th>' +
						'<th></th>' +
					'</tr>' +
				'</thead>';
	
	var totalEgresos = 0;
	var totalIngresos = 0;
	var totalVisaEgresos = 0;
	var totalMasterCardEgresos = 0;
	var totalAmexEgresos = 0;
	var totalAprobadaEgresos = 0;
	var totalNoAprobadaEgresos = 0;
	var totalReversadaEgresos = 0;
	
	var totalVisaIngresos = 0;
	var totalMasterCardIngresos = 0;
	var totalAmexIngresos = 0;
	var totalAprobadaIngresos = 0;
	var totalNoAprobadaIngresos = 0;
	var totalReversadaIngresos = 0;
	var comision = 0.00

	$.each(JSON.parse(transacciones), function(index, item) {

		color = "";
		estatus = "";
		comision = 0.00;
		
		if (item.reversed) {
			color = "warning";
			estatus = "Reversada";
			totalReversadaEgresos += parseFloat(item.amount);
		} else {
			if (item.approved) {
				color = "success";
				estatus = "Aprobada";
				
				if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "0") {
					comision = 0.0178;
					
					if (item.card_brand == "VISA") { 
						totalVisaIngresos += parseFloat(item.amount);
						totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
					} else {
						if (item.card_brand == "MASTER CARD") { 
							totalMasterCardIngresos += parseFloat(item.amount);
							totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						}
					}
				}else {
					if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "1") {
						comision = 0.014;
						
						if (item.card_brand == "VISA") { 
							totalVisaIngresos += parseFloat(item.amount);
							totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						} else {
							if (item.card_brand == "MASTER CARD") { 
								totalMasterCardIngresos += parseFloat(item.amount);
								totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
							}
						}
						
						
					}else {
						if (item.card_brand == "AMEX") {
							comision = 0.027;
							
							totalAmexIngresos += parseFloat(item.amount);
							totalAmexEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						}
					}
				}
				
				totalAprobadaIngresos += parseFloat(item.amount);
				totalAprobadaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
				
				totalIngresos += parseFloat(item.amount);
				totalEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
			} else {
				color = "danger";
				estatus = "No Aprobada";
				// totalNoAprobadaIngresos += parseFloat(item.amount);
			}
		}

		html += '<tr class="list-transacciones-dinamicas ' + item.card_brand.toLowerCase().replace(" ", "-") + ' ' + estatus.toLowerCase().replace(" ", "-") + '">' +
					'<td><input type="checkbox" name="idTransaccionCheck' + item.id + '" id="idTransaccionCheck' + item.id + '" value="' + item.id + '" /></td>' +
					'<td nowrap>' + item.transaction_date.substr(0, 10) + ' ' + item.transaction_date.substr(11, 5) + '</td>' +
					'<td>' + item.card_brand + ' - ' + item.card_number + '</td>' +
					'<td>' + tipos[item.card_type] + '</td>' +
					'<td class="text-right"><strong>$' + $.number(item.amount, 2) + '</strong></td>' +
					'<td class="text-center">' +
						'<span class="badge badge-pill badge-' + color + '">' + estatus + '</span>' +
					'</td>' +
					'<td>' +
						'<button aria-expanded="false" aria-haspopup="true" class="btn btn-white dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" type="button"><span class="sr-only">Toggle Dropdown</span></button>' +
						'<div class="dropdown-menu" style="">' +
							'<a class="dropdown-item" href="' + url + 'incidencias/nuevaIncidencia/' + item.id + '"> Incidencia</a>' +
							'<a class="dropdown-item" href="' + url + 'pins/nuevoPin/Transaccion/' + item.id + '"> Pin</a>' +
							'<a class="dropdown-item" href="' + url + 'transacciones/comprobanteTransaccion/' + item.id + '"> Comprobante</a>' +
						'</div>' +
					'</td>' +
				'</tr>';
	});
	
	html +=		'<tfoot>' +
					'<tr>' +
						'<td colspan="4"></td>' +
						'<td class="text-right"><strong class="p-0 m-0">$<span id="lblTotalIngresos1"> ' + $.number(totalIngresos, 2) + '</span></strong></td>' +
						'<td></td>' +
						'<td></td>' +
					'</tr>' +
				'</tfoot>' +
			'</table>' +
			'<input type="hidden" name="totalVisaIngresos" id="totalVisaIngresos" value="' + totalVisaIngresos + '" />' +
			'<input type="hidden" name="totalMasterCardIngresos" id="totalMasterCardIngresos" value="' + totalMasterCardIngresos + '" />' +
			'<input type="hidden" name="totalAmexIngresos" id="totalAmexIngresos" value="' + totalAmexIngresos + '" />' +
			'<input type="hidden" name="totalAprobadaIngresos" id="totalAprobadaIngresos" value="' + totalAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaIngresos" id="totalNoAprobadaIngresos" value="' + totalNoAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalReversadaIngresos" id="totalReversadaIngresos" value="' + totalReversadaIngresos + '" />' +
			'<input type="hidden" name="totalVisaEgresos" id="totalVisaEgresos" value="' + totalVisaEgresos + '" />' +
			'<input type="hidden" name="totalMasterCardEgresos" id="totalMasterCardEgresos" value="' + totalMasterCardEgresos + '" />' +
			'<input type="hidden" name="totalAmexEgresos" id="totalAmexEgresos" value="' + totalAmexEgresos + '" />' +
			'<input type="hidden" name="totalAprobadaEgresos" id="totalAprobadaEgresos" value="' + totalAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaEgresos" id="totalNoAprobadaEgresos" value="' + totalNoAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalReversadaEgresos" id="totalReversadaEgresos" value="' + totalReversadaEgresos + '" />' +
			'<input type="hidden" name="totalEgresos" id="totalEgresos" value="' + totalEgresos + '" />' +
			'<input type="hidden" name="totalIngresos" id="totalIngresos" value="' + totalIngresos + '" />';

	$("#transacciones-dinamicas").html(html);
	$('#lblTotalIngresos').html($.number(totalIngresos, 2));
	$('#lblTotalEgresos').html($.number(totalEgresos, 2));

	return false;
}

function filtrarUltimasTransacciones() {
	var idComercio = $('#idComercio').val();
	var idTerminal = "-1";
	var dias = $('#dias option:selected').val();
	
	var html = "";
	var color = "";
	var estatus = "";
	
	dias = parseInt(dias);
	
	if (dias != 0) {
		
		var fechaTermino = new Date();

		fechaTermino.setDate(fechaTermino.getDate());
		// fechaInicio = Date.parse(fechaInicio);

		var month = '' + (fechaTermino.getMonth() + 1),
			day = '' + fechaTermino.getDate(),
			year = fechaTermino.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaTermino = [year, month, day].join('-');

		var arrayFechaTermino = fechaTermino.split('-'); 

		var fechaInicio = new Date(arrayFechaTermino[0], arrayFechaTermino[1]-1, arrayFechaTermino[2]);

		fechaInicio.setDate(fechaInicio.getDate() - dias);
		// fechaInicio = Date.parse(fechaInicio);

		month = '' + (fechaInicio.getMonth() + 1);
		day = '' + fechaInicio.getDate();
		year = fechaInicio.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		fechaInicio = [year, month, day].join('-');
	} else {
		fechaInicio = "2022-10-01";
		fechaTermino = "2022-10-30";
	}
	
	var transacciones = $.ajax({
		url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + fechaInicio + "/" + fechaTermino,
		dataType: "json",
		global: false,
		async: false,
		success: function(result) {
			return result;
		}
	}).responseText;

	if (dias != 0) {
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - ' + dias +  ' dias' +
			   '</h6>';
	} else {
		
		html = '<h6 class="element-header mb-3">' +
					'Últimas Transacciones - Mes actual' +
			   '</h6>';
	}
	
		html +=	
				'<div class="row">' +
					'<div class="col-md-12 mb-2">' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'visa\'); actualizarTotalesTablero(\'Visa\');"><span class="badge badge-pill badge-primary mr-1">Visa</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'master-card\'); actualizarTotalesTablero(\'MasterCard\');"><span class="badge badge-pill badge-primary mr-1">Master Card</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'amex\'); actualizarTotalesTablero(\'Amex\');"><span class="badge badge-pill badge-primary mr-1">AMEX</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'aprobada\'); actualizarTotalesTablero(\'Aprobada\');"><span class="badge badge-pill badge-success mr-1">Aprobada</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'no-aprobada\'); actualizarTotalesTablero(\'NoAprobada\');"><span class="badge badge-pill badge-danger mr-1">No Aprobada</span></a>' +
						'<a href="javascript: filtrarLocal(\'transacciones-tablero\', \'reversada\'); actualizarTotalesTablero(\'Reversada\');"><span class="badge badge-pill badge-warning mr-1">Reversada</span></a>' +
					'</div>' +
				'</div>' +
				'<div class="element-box-tp" style="height: 650px; overflow-y: scroll;">' +
					'<table class="table table-clean">';
	
	
	var totalEgresos = 0;
	var totalIngresos = 0;
	var totalVisaEgresos = 0;
	var totalMasterCardEgresos = 0;
	var totalAmexEgresos = 0;
	var totalAprobadaEgresos = 0;
	var totalNoAprobadaEgresos = 0;
	var totalReversadaEgresos = 0;
	
	var totalVisaIngresos = 0;
	var totalMasterCardIngresos = 0;
	var totalAmexIngresos = 0;
	var totalAprobadaIngresos = 0;
	var totalNoAprobadaIngresos = 0;
	var totalReversadaIngresos = 0;
	var comision = 0.00

	$.each(JSON.parse(transacciones), function(index, item) {

		color = "";
		estatus = "";
		comision = 0.00;
		
		if (item.reversed) {
			color = "warning";
			estatus = "Reversada";
			totalReversadaEgresos += parseFloat(item.amount);
		} else {
			if (item.approved) {
				color = "success";
				estatus = "Aprobada";
				
				if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "0") {
					comision = 0.0178;
					
					if (item.card_brand == "VISA") { 
						totalVisaIngresos += parseFloat(item.amount);
						totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
					} else {
						if (item.card_brand == "MASTER CARD") { 
							totalMasterCardIngresos += parseFloat(item.amount);
							totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						}
					}
							
				}else {
					if ((item.card_brand == "VISA" || item.card_brand == "MASTER CARD") && item.card_type == "1") {
						comision = 0.014;
						
						if (item.card_brand == "VISA") { 
							totalVisaIngresos += parseFloat(item.amount);
							totalVisaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
						} else {
							if (item.card_brand == "MASTER CARD") { 
								totalMasterCardIngresos += parseFloat(item.amount);
								totalMasterCardEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
							}
						}
					}else {
						if (item.card_brand == "AMEX") {
							comision = 0.027;
							
							
							totalAmexIngresos += parseFloat(item.amount);
							totalAmexEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
							
						}
					}
				}
				
				totalAprobadaIngresos += parseFloat(item.amount);
				totalAprobadaEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
				
				totalIngresos += parseFloat(item.amount);
				totalEgresos += parseFloat(item.amount-(item.amount*comision)-(item.amount*comision*0.16));
			} else {
				color = "danger";
				estatus = "No Aprobada";
				// totalNoAprobadaIngresos += parseFloat(item.amount);
			}
		}

		html += '<tr class="list-transacciones-tablero  ' + item.card_brand.toLowerCase().replace(" ", "-") + ' ' + estatus.toLowerCase().replace(" ", "-") + '">' +
					'<td>' +
						'<div class="value">' + item.card_brand + ' - ' + item.card_number + '</div>' +
						'<span class="sub-value"><span class="text-' + color + '">' + estatus + '</span></span>' +
					'</td>' +
					'<td class="text-right">' +
						'<div class="value">' +
							'$' + $.number(item.amount, 2) + ' <small>MXN</small>' +
						'</div>' +
						'<span class="sub-value">' + item.transaction_date.substr(0, 10) + ' ' + item.transaction_date.substr(11, 5) + '</span>' +
					'</td>' +
				'</tr>';
	});
	
	html +=		'</table>' +
			'</div>' +
			'<input type="hidden" name="totalVisaIngresos" id="totalVisaIngresos" value="' + totalVisaIngresos + '" />' +
			'<input type="hidden" name="totalMasterCardIngresos" id="totalMasterCardIngresos" value="' + totalMasterCardIngresos + '" />' +
			'<input type="hidden" name="totalAmexIngresos" id="totalAmexIngresos" value="' + totalAmexIngresos + '" />' +
			'<input type="hidden" name="totalAprobadaIngresos" id="totalAprobadaIngresos" value="' + totalAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaIngresos" id="totalNoAprobadaIngresos" value="' + totalNoAprobadaIngresos + '" />' +
			'<input type="hidden" name="totalReversadaIngresos" id="totalReversadaIngresos" value="' + totalReversadaIngresos + '" />' +
			'<input type="hidden" name="totalVisaEgresos" id="totalVisaEgresos" value="' + totalVisaEgresos + '" />' +
			'<input type="hidden" name="totalMasterCardEgresos" id="totalMasterCardEgresos" value="' + totalMasterCardEgresos + '" />' +
			'<input type="hidden" name="totalAmexEgresos" id="totalAmexEgresos" value="' + totalAmexEgresos + '" />' +
			'<input type="hidden" name="totalAprobadaEgresos" id="totalAprobadaEgresos" value="' + totalAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalNoAprobadaEgresos" id="totalNoAprobadaEgresos" value="' + totalNoAprobadaEgresos + '" />' +
			'<input type="hidden" name="totalReversadaEgresos" id="totalReversadaEgresos" value="' + totalReversadaEgresos + '" />' +
			'<input type="hidden" name="totalEgresos" id="totalEgresos" value="' + totalEgresos + '" />' +
			'<input type="hidden" name="totalIngresos" id="totalIngresos" value="' + totalIngresos + '" />' +
			'<a class="centered-load-more-link" href=" ' + url + 'transacciones/index/' + idComercio + '"><span>Ver todas transacciones</span></a>';

	$("#transacciones-tablero").html(html);
	$('#lblTotalIngresos').html($.number(totalIngresos, 2));
	$('#lblTotalEgresos').html($.number(totalEgresos, 2));

	return false;
}

function actualizarTotalesComisiones(estatus) {

	var totalImporte = $('#total' + estatus + 'Importe').val();
	var totalComisiones = $('#total' + estatus + 'Comisiones').val();
	var totalIVA = $('#total' + estatus + 'IVA').val();
	
	$('#lblTotalImporte').html($.number(totalImporte, 2));
	$('#lblTotalComisiones').html($.number(totalComisiones, 2));
	$('#lblTotalIVA').html($.number(totalIVA, 2));
	
	$('#lblTotalImporte1').html($.number(totalImporte, 2));
	$('#lblTotalComisiones1').html($.number(totalComisiones, 2));
	$('#lblTotalIVA1').html($.number(totalIVA, 2));
	
}

function actualizarTotalesTablero(estatus) {

	var totalIngresos = $('#total' + estatus + 'Ingresos').val();
	var totalEgresos = $('#total' + estatus + 'Egresos').val();
	
	$('#lblTotalIngresos').html($.number(totalIngresos, 2));
	$('#lblTotalEgresos').html($.number(totalEgresos, 2));
	
}

function actualizarTotalesTransacciones(estatus) {

	var totalIngresos = $('#total' + estatus + 'Ingresos').val();
	var totalEgresos = $('#total' + estatus + 'Egresos').val();
	
	$('#lblTotalIngresos').html($.number(totalIngresos, 2));
	$('#lblTotalEgresos').html($.number(totalEgresos, 2));
	$('#lblTotalIngresos1').html($.number(totalIngresos, 2));
	
}

function actualizarComercio(idComercio, menu){
	$.ajax({
		url: url + "login/ajaxActualizarComercio/" + idComercio,
		dataType: "JSON",
		type: "POST"
	}).done(function(result) {
		var urlRedirect = url + menu;
		$(location).attr('href', urlRedirect);
	});
}

function filtrarLocal(id, estatus) {
	
	$('#' + id + ' .list-' + id).hide();
	
	$('#' + id + ' .' + estatus).show();
}
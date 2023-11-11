$(document).ready(function() {
			
	$("#calendario-mini").zabuto_calendar({
		language: "es",
		year: 2022,
		show_previous: true,
		show_next: 21,
		nav_icon: { 
			prev: '<i class="os-icon os-icon-arrow-left2"></i>', 
			next: '<i class="os-icon os-icon-arrow-right4"></i>' 
		},
		
		action: function () {
			return cargarTransaccionesDinamica(this.id);
		},
		data: eventData
	});	

	function cargarTransaccionesDinamica(id) {
		var date = $("#" + id).data("date");
		
		var idTerminal = $("#idTerminal option:selected").val();
		var idComercio = $("#idComercio").val();
		var idDateCalendar = id;
		var html = "";
		var color = "";
		var estatus = "";
		var dia = "";
		var mes = "";
		var ano = "";
		var meses = {"01": 'Enero', "02": 'Febrero', "03": 'Marzo', "04": 'Abril', "05": 'Mayo', "06": 'Junio', "07": 'Julio', "08": 'Agosto', "09": 'Septiembre', "10": 'Octubre', "11": 'Noviemnbre', "12": "Diciembre"};
 		
		console.log(date);

		var transacciones = $.ajax({
			url: url + "transacciones/ajaxObtenerTransaccionesPorFecha/" + idComercio + "/" + idTerminal + "/" + date + "/" + date,
			dataType: "json",
			global: false,
			async: false,
			success: function(result) {
				return result;
			}
		}).responseText;
		
		dia = date.substr(8, 2);
		mes = date.substr(5, 2);
		ano = date.substr(0, 4);

		html = '<h6 class="font-size-14 ms-3 mb-3">' + meses[mes] + ' ' + dia + ', ' + ano + '</h6>';
		
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
		
		// html += '</div>';
		
		$("#transacciones-dinamicas").html(html);

		return false;
	}
});
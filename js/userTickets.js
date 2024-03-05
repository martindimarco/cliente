$(function () {
	$.ajax({
		method: "POST",
		url: "./php/userTickets.php",
		data: {
			consulta: "datosDelSelect"
		}
	}).done(function (msg) {

		let allDataFromUser = JSON.parse(msg);


		let contracts = allDataFromUser.contracts;
		let tickets = allDataFromUser.tickets;

		let $selectModalContratos = $('#selectModalContratos');
		let $cabeceraDelMensaje = $('#cabeceraDelMensaje');
		let $cuerpoMsj = $('#cuerpoMsj');
		let $timer = $('#timer');

		// datos del history
		$.each(contracts, function () {
			$selectModalContratos.append($('<option>', {
				text: this.cups.code + " - " + this.client.address + "  " + this.client.city + ", " + this.client.city2,
				value: this.cups.code
			}));
		});

		$.each(tickets, function () {
			$cabeceraDelMensaje.append($('<option>', {
				text: this.title
			}));
		});

		$.each(tickets, function () {
			$cuerpoMsj.append($('<p>', {
				text: this.messages[0].message,
				class: "text-secondary p-2"
			}));
		});
		$.each(tickets, function () {
			$cuerpoMsj.append($('<p>', {
				text: this.messages[1].message,
				class: "text-secondary p-2"
			}));
		});

		$.each(tickets, function () {
			$timer.append($('<span>', {
				text: "fecha: 01/01/2000",
				class: "text-secondary p-2",
				style: "font-size: 12px; color:lightseagreen !important;"
			}));
		});


	});
});

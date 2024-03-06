$(function () {
	$.ajax({
		method: "POST",
		url: "./php/bolsillo.php",
		data: {
			consulta: "datosDelSelect"
		}
	}).done(function (msg) {

		let allDataFromBolsillo = JSON.parse(msg);
		let contracts = allDataFromBolsillo;
		let $bolsilloSelect = $('#selectContratos');


		// datos del select principal
		$.each(contracts, function () {
			$bolsilloSelect.append($('<option>', {
				text: this.cups.code + " - " + this.client.address + "  " + this.client.city + ", " + this.client.city2,
				value: this.cups.code
			}));


		});
	});

	$("#selectContratos").change(function () {
		selectChange();
	});

	function selectChange() { // show info in principal select
		var valor = $('#selectContratos').val();

		$.ajax({
			method: "POST",
			url: "./php/bolsillo.php",
			data: {
				cups: valor,
				consulta: "cups"

			}
		}).done(function (msg) {

			let allDataFromBolsillo = JSON.parse(msg);
			let contracts = allDataFromBolsillo;
			let $bolsilloSelect = $('#selectContratos');
			let $codigoAmigo = $('.codigoAmigo');
			let codigoAmigo = contracts["codigoAmigo"];


			// datos del select principal
			$.each(contracts, function () {
				$bolsilloSelect.append($('<option>', {
					text: this.cups.code + " - " + this.client.address + "  " + this.client.city + ", " + this.client.city2,
					value: this.cups.code
				}));

				$codigoAmigo.text(codigoAmigo);


				$bolsilloModalCups = $('#bolsilloModalCups');
				$bolsilloModalAddress = $('#bolsilloModalAddress');
				$bolsilloModalCity2 = $('#bolsilloModalCity2');
				$bolsilloModalCity = $('#bolsilloModalCity');
				$bolsilloModalCp = $('#bolsilloModalCp');

				$bolsilloModalCups.attr('value', this.cups.code);
				$bolsilloModalAddress.attr('value', this.client.address);
				$bolsilloModalCity2.attr('value', this.client.city2);
				$bolsilloModalCity.attr('value', this.client.city);
				$bolsilloModalCp.attr('value', this.client.pcode);

			});
		});
	}
});

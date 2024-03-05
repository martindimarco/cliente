$(function () {
	$.ajax({
		method: "POST",
		url: "./php/user.php",
		data: {
			consulta: "datosDelSelect"
		}
	}).done(function (msg) {

		let allDataFromUser = JSON.parse(msg);
		let contracts = allDataFromUser;
		let $dropdown = $('#selectUser');

		// datos del select principal
		$.each(contracts, function () {
			$dropdown.append($('<option>', {
				text: this.cups.code + " - " + this.client.address + "  " + this.client.city + ", " + this.client.city2,
				value: this.cups.code
			}));
		});
	});

	$("#selectUser").change(function () {
		selectChange();
	});


	function selectChange() {
		var valor = $('#selectUser').val();


		$.ajax({
			method: "POST",
			url: "./php/user.php",
			data: {
				cups: valor,
				consulta: 'cups'
			}

		}).done(function (msg) {

			let allDataFromUser = JSON.parse(msg);
			let contracts = allDataFromUser;


			$cups = $('#selectUser').val();
			$datosCups_rojo = $('#datosCups_rojo');

			console.log($cups);

			// show Datos Generales = DG
			$userCodigoContratoDP = $('#userCodigoContratoDP');
			$userNifDP = $('#userNifDP');
			$userNombreDP = $('#userNombreDP');
			$userApellidoDP = $('#userApellidoDP');
			$fechaInicioDP = $('#fechaInicioDP');
			$userDuracionDP = $('#userDuracionDP');
			$userFechaActivacionAutoConsumoDP = $('#userFechaActivacionAutoConsumoDP');
			$userIbanDP = $('#userIbanDP');

			$.each(contracts, function () {
				$datosCups_rojo.text($cups);
				$userCodigoContratoDP.attr('placeholder', this.code);
				$userNifDP.attr('placeholder', this.client.code);
				$userNombreDP.attr('placeholder', this.client.name);
				$userApellidoDP.attr('placeholder', this.client.name2);
				$fechaInicioDP.attr('placeholder', this.details.date_active);
				$userDuracionDP.attr('placeholder', this.details.duration);
				$userFechaActivacionAutoConsumoDP.attr('placeholder', this.details.date_proc);
				$userIbanDP.attr('placeholder', this.details.iban);
				$datosCups_rojo.attr('placeholder', this.code);
				tipoContrato = this.client.type;
			});

			// show Datos Cups = DC
			$userAddressDC = $('#userAddressDC');
			$userCpDC = $('#userCpDC');
			$userCityDC = $('#userCityDC');
			$userCity2DC = $('#userCity2DC');
			$userTarifaDC = $('#userTarifaDC');
			$userDistribuidoraDC = $('#userDistribuidoraDC');
			$userAutoconsumoDC = $('#userAutoconsumoDC');
			$userContratoDC = $('#userContratoDC');

			let tipoContratoDevuelto;

			switch (tipoContrato) {
				case "F": tipoContratoDevuelto = "Fijo";
					break;
				case "I": tipoContratoDevuelto = "Indexado";
					break;
				case "M": tipoContratoDevuelto = "Mixto";
					break;
				case "S": tipoContratoDevuelto = "Semi Indexado";
					break;

				default: tipoContratoDevuelto = "Sin datos";
					break;
			}


			$.each(contracts, function () {
				$userAddressDC.attr("placeholder", this.client.address);
				$userCpDC.attr('placeholder', this.client.pcode);
				$userCityDC.attr('placeholder', this.client.city);
				$userCity2DC.attr('placeholder', this.client.city2);
				$userTarifaDC.attr('placeholder', this.details.tarif);
				$userDistribuidoraDC.attr('placeholder', this.cups.dist);
				let compararAutoconsum = this.details.autoconsum_act;
				compararAutoconsum === undefined ? $userAutoconsumoDC.attr('placeholder', "Sin Datos") : $userAutoconsumoDC.attr('placeholder', this.details.autoconsum_act);
				$userContratoDC.attr('placeholder', tipoContratoDevuelto);
			});

			// Potencia contratada
			$userPotenciaContratadaP1 = $('#userPotenciaContratadaP1');
			$userPotenciaContratadaP2 = $('#userPotenciaContratadaP2');
			$userPotenciaContratadaP3 = $('#userPotenciaContratadaP3');
			$userPotenciaContratadaP4 = $('#userPotenciaContratadaP4');
			$userPotenciaContratadaP5 = $('#userPotenciaContratadaP5');
			$userPotenciaContratadaP6 = $('#userPotenciaContratadaP6');

			// Precio potencia
			$userPrecioP1DC = $('#userPrecioP1DC');
			$userPrecioP2DC = $('#userPrecioP2DC');
			$userPrecioP3DC = $('#userPrecioP3DC');
			$userPrecioP4DC = $('#userPrecioP4DC');
			$userPrecioP5DC = $('#userPrecioP5DC');
			$userPrecioP6DC = $('#userPrecioP6DC');

			// Precio energia
			$userEnergiaE1DC = $('#userEnergiaE1DC');
			$userEnergiaE2DC = $('#userEnergiaE2DC');
			$userEnergiaE3DC = $('#userEnergiaE3DC');
			$userEnergiaE4DC = $('#userEnergiaE4DC');
			$userEnergiaE5DC = $('#userEnergiaE5DC');
			$userEnergiaE6DC = $('#userEnergiaE6DC');

			$.each(contracts, function () { // Mostrar potencia contratada
				let evaluador = this.details.pow_signed;
				let evaluador2 = this.details.pow_signed2;
				let evaluador3 = this.details.pow_signed3;
				let evaluador4 = this.details.pow_signed4;
				let evaluador5 = this.details.pow_signed5;
				let evaluador6 = this.details.pow_signed6;

				(evaluador.trim() !== "") ? $userPotenciaContratadaP1.text(this.details.pow_signed) : $userPotenciaContratadaP1.text("-");
				(evaluador2.trim() !== "") ? $userPotenciaContratadaP2.text(this.details.pow_signed2) : $userPotenciaContratadaP2.text("-");
				(evaluador3.trim() !== "") ? $userPotenciaContratadaP3.text(this.details.pow_signed3) : $userPotenciaContratadaP3.text("-");
				(evaluador4.trim() !== "") ? $userPotenciaContratadaP4.text(this.details.pow_signed4) : $userPotenciaContratadaP4.text("-");
				(evaluador5.trim() !== "") ? $userPotenciaContratadaP5.text(this.details.pow_signed5) : $userPotenciaContratadaP5.text("-");
				(evaluador6.trim() !== "") ? $userPotenciaContratadaP6.text(this.details.pow_signed6) : $userPotenciaContratadaP6.text("-");


				$userPrecioP1DC.text(`${
					this.details.price
				}`);
				$userPrecioP2DC.text(`${
					this.details.price2
				}`);
				$userPrecioP3DC.text(`${
					this.details.price3
				}`);
				$userPrecioP4DC.text(`${
					this.details.price4
				}`);
				$userPrecioP5DC.text(`${
					this.details.price5
				}`);
				$userPrecioP6DC.text(`${this.details.price6}`);
			})


			$.each(contracts, function () {
				$userUssNameDP = $('#userUssNameDP');
				$userTlfDP = $('#userTlfDP');
				$userNameDP = $('#userNameDP');
				$userLastNameDP = $('#userLastNameDP');
				$userHorarioPreferenteDP = $('#userHorarioPreferenteDP');

				$userUssNameDP.attr('value', this.client.code);
				$userTlfDP.attr('value', this.client.tel);
				$userNameDP.attr('value', this.client.name);
				$userLastNameDP.attr('value', this.client.name2);
				$userHorarioPreferenteDP.attr('value', "Sin horario");
			})


			$.each(contracts, function () {
				$userEnergiaE1DC.text(`${
					this.details.pow_cons
				}`);
				$userEnergiaE2DC.text(`${
					this.details.pow_cons2
				}`);
				$userEnergiaE3DC.text(`${
					this.details.pow_cons3
				}`);
				$userEnergiaE4DC.text(`${
					this.details.pow_cons4
				}`);
				$userEnergiaE5DC.text(`${
					this.details.pow_cons5
				}`);
				$userEnergiaE6DC.text(`${
					this.details.pow_cons6
				}`);
			})
		});

	};

	$("#guardarDatos").on("click", function datosGuardados() {
		alert("Datos guardados correctamente");
	});
});

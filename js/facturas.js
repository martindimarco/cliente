var table = "";
$('document').ready(function () { 
	// DATATABLE
	table = $('#t1').DataTable({
		info: false,
		ordering: false,
		paging: false,
		scrollCollapse: true,
		scrollY: '63vh',
		scrollX: false,
		responsive: true,
		columns: [
			{data: "Fecha"},{data: "Factura"},{data: "Desde"},{data: "Hasta"}, {data: "Consumo"}, {data: "Total"}, {data: "Descargar"},
		],

		"lengthMenu": [
			[10, 25, 50, -1],[10, 25, 50, "All"]
		],
		"language": {
			"url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
			// buttons: {
			// 	copyTitle: 'Datos copiados al portapapeles',
			// 	copySuccess: {
			// 		_: '%d registros copiados',
			// 		1: '1 registro copiado'
			// 	}
			// }
		},
		// dom: 'lBfrtip',
		// buttons: [
		//         { extend: 'copyHtml5', footer: true, exportOptions: {columns: ':visible'} },
		//         { extend: 'excelHtml5', footer: true, exportOptions: {columns: ':visible',
		//         format: {
		//             body: function(data, row, column, node) {
		//                 data = $('<p>' + data + '</p>').text();
		//                 return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
		//             },
		//             footer: function(data, row, column, node) {
		//                 data = $('<p>' + data + '</p>').text();
		//                 return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
		//             }
		//         }} },
		//         { extend: 'csvHtml5', footer: true, exportOptions: {columns: ':visible'} },
		//         { extend: 'pdfHtml5', footer: true, exportOptions: {columns: ':visible'} },
		//         { extend: 'print', footer: true, exportOptions: {columns: ':visible'} }
		//     ]
	});

	var cargarSelect = function onCargarSelect() {
		$.ajax({
			method: "POST",
			url: "./php/facturas.php",
			data: {
				consulta: "datosDelSelect"
			}
		}).done(function (msg) { // parseo el string c/formato json a un objeto

			allDataFromIndex = JSON.parse(msg);

			// separo los la info de allDataFromIndex e contracts e invoices_ext
			let contracts = allDataFromIndex.contracts; 
			let invoices_ext = allDataFromIndex.invoices_ext;

			// capturo el id del select y lo meto en una variable
			let $dropdown = $("#selectContratos");

			// uso index para poder concatenar y acceder a invoices_ext o cualquier otra collection
			$.each(contracts, function () {
				$dropdown.append($("<option>", { // uso el método concat para unir las cadenas con un guion
					text: this.cups.code + " - "+ this.codecom + " - " + this.client.address + " - " + this.client.city + " - " + this.client.city2,
					value: this.cups.code + "@" + this.codecom + "@" + this.client.code
				}));
			});
		});
	}

	$("#selectContratos").change(function () {
		selectChange();
	});

	function selectChange() {
		var valores = $('#selectContratos').val().split('@')
		var valor = valores[0];
		var marca = valores[1];
		var cif = valores[2];

		$.ajax({
			method: "POST",
			url: "./php/facturas.php",
			data: {
				cups: valor,
				cif: cif,
				marca: marca,
				consulta: 'cups'
			}
		}).done(function (msg) {
			let contracts = JSON.parse(msg);
			cargarInfoContrato(contracts);
			populateTable(contracts);
		});
	}

	var cargarInfoContrato = function onCargarInfoContrato(contracts) { // // capturo el id del select y lo meto en una variable
		let $brand_addressTable = $("#brand_addressTable");
		let $cups_addressTable = $("#cups_addressTable");
		let $address_addressTable = $("#address_addressTable");
		let $location1_addressTable = $("#location1_addressTable");
		let $location2_addressTable = $("#location2_addressTable");
		let $cp_addressTable = $("#cp_addressTable");

		$.each(contracts, function () {
			$brand_addressTable.text(this.codecom);
			$cups_addressTable.text(this.cups.code);
			$address_addressTable.text(this.client.address);
			$location1_addressTable.text(this.client.city2);
			$location2_addressTable.text(this.client.city);
			$cp_addressTable.text(this.client.pcode);
		})
	}

	// Recorremos el resultado y cargarmos los datos en el Datatable
	var populateTable = function onPopulateTable(contracts) {
		table.clear().draw();

		$.each(contracts, function () {
			contracts_row = {
				"Fecha": this.details.date_active,
				"Factura": this.client.name,
				"Desde": this.details.date_end,
				"Hasta": this.client.mail,
				"Consumo": this.client.code,
				"Total": this.client.code,
				"Descargar": this.client.name
		};
			table.row.add(contracts_row).node().className="tbody";
		})
			table.draw(false);
	}
	cargarSelect();
});

// funcion para copiar el cups en el clipboard
const EMPTY_CUPS_COPY = "\n                            ";
async function copyCups() {
	let cupsCopiado = $("#cups_addressTable").text();
	if (cupsCopiado === EMPTY_CUPS_COPY) {} else {
		try {
			await navigator.clipboard.writeText(cupsCopiado);
			alert(`El cups fue copiado correctamente`);
		} catch (err) {
			console.error('Error al copiar: ', err);
		}
	}
}

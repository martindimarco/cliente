$(document).ready(function () { // uppercase para usuario
	$('#usu').change('input', function () {
		var $usu = $(this).val();
		$(this).val($usu.toUpperCase());
	});


	$entrar = $('#entrar').click(function () {

		$usuLogin = $('#usu').val();
		$passLogin = $('#pass').val();

		


		$.ajax({
			type: "POST",
			url: "./php/index.php",
			data: {
				usuario: $usuLogin,
				password: $passLogin
			},
			success: function (msg) {
				$msgFromLogin = JSON.parse(msg);

				// PENDIENTE DE REVISAR CUANDO LOS CAMPOS ESTEN VACIOS. 
				if ($usuLogin == "") {
					$('#usu').attr('placeholder', 'No puede estar vacio').addClass('errorLogin');
				}
				if ($passLogin == "") {
					$('#pass').attr('placeholder', 'No puede estar vacio').addClass('errorLogin');
				}

				if ($msgFromLogin == 'OK') {
					$(location).attr('href', './facturas.html');
				} else {
					if ($msgFromLogin == 'KO_nif') {
						$('#usu').val('Usuario incorrecto').addClass('errorLogin');
					}
					if ($msgFromLogin == 'KO_pass') {
						$('#pass').val('Contraseña incorrecta').addClass('errorLogin');
					}
					if ($msgFromLogin == 'error') {
						console.log("Error en usuario o contraseña");
					}
				}
			}
		});
	});
});

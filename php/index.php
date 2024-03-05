<?php
session_start();

require '../vendor/autoload.php';

$conn_userscups_auto = (new MongoDB\Client)->gdc->userscups_auto;
$conn_userscups = (new MongoDB\Client)->gdc->userscups;

// compruebo que al pass y usu no esten vacios o no inicializados, en ese caso devuelve un "nd"
$usu = (isset($_POST['usuario']) && !empty($_POST['usuario'])) ? $_POST['usuario'] : "ndUsu";
$pass = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : "ndPass";

$_SESSION['usu'] = $usu;

// si la pass y el usu no es "nd" entrar
if ($usu != "ndUsu" && $pass != "ndPass") {
  $pointer_userscups_auto = $conn_userscups_auto->findOne(['NIF' => $usu]);
  $comprobacionNIF = $pointer_userscups_auto['NIF'] ?? "nif_error";
  $comprobacionClave = $pointer_userscups_auto['Clave'] ?? "pass_error";

  // si el usu es igual a comprobar nif entrar
  if (($usu == $comprobacionNIF)) {
    $claveBD_fromUsercups_auto = $pointer_userscups_auto['Clave BD'];
    $pointer_userscups = $conn_userscups->findOne(['password' => $claveBD_fromUsercups_auto]);
    $password_fromUsercups = $pointer_userscups['password'];
    // si el hash de cups es igual al hash de cups_auto y la pass es igual a la clave entrar
    if ($claveBD_fromUsercups_auto == $password_fromUsercups) {
      $msg = json_encode("OK");
    }
  }
  if ($pass != $comprobacionClave) {
    $msg = json_encode("KO_pass");
  }
  if ($usu != $comprobacionNIF) {
    $msg = json_encode("KO_nif");
  }
} else {
  $msg = json_encode("error");
}

echo $msg;
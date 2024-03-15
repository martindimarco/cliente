<?php
session_start();
require '../vendor/autoload.php';

$valueFromUserJs = isset($_POST['cups']) ? $_POST['cups'] : "sin datos recibidos";
$tipoConsulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$session_usuFromLogin = $_SESSION['usu'];

$connContracts = (new MongoDB\Client)->gdc->contracts;

switch ($tipoConsulta) {
  case "datosDelSelect":
    $pointerContracts = $connContracts->find(['client.code' => $session_usuFromLogin]);
    $soloCups = [];

    foreach ($pointerContracts as $show) {
      array_push($soloCups, $show);
    };

    $soloCupsEncode = json_encode($soloCups);
    break;

  case "cups":
    $pointerContracts = $connContracts->find(['client.code' => $session_usuFromLogin]);
    $soloCups = [];

    foreach ($pointerContracts as $show) {
      array_push($soloCups, $show);
    };

    $soloCupsEncode = json_encode($soloCups);
    break;
}

echo ($soloCupsEncode);

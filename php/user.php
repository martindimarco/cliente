<?php
session_start();
require '../vendor/autoload.php';

$valueFromUserJs = isset($_POST['cups']) ? $_POST['cups'] : "sin datos recibidos";
$tipoConsulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";

$connContracts = (new MongoDB\Client)->gdc->contracts;

switch ($tipoConsulta) {
  case "datosDelSelect":
    $pointerContracs = $connContracts->find(
      ['codecom' => 'ISM'],
      ['projection' =>
      [
        'sips' => 0,
        'crm' => 0,
        'erp' => 0,
        'Comisiones' => 0
      ]]
    );

    $soloCups = [];

    foreach ($pointerContracs as $show) {
      array_push($soloCups, $show);
    };

    $soloCupsEncode = json_encode($soloCups);

    break;
  case "cups":
    $pointerContracs = $connContracts->find(
      ['codecom' => 'ISM', 'cups.code' => $valueFromUserJs],
      ['projection' =>
      [
        'sips' => 0,
        'crm' => 0,
        'erp' => 0,
        'Comisiones' => 0
      ]]
    );

    $soloCups = [];

    foreach ($pointerContracs as $show) {
      array_push($soloCups, $show);
    };

    $soloCupsEncode = json_encode($soloCups);

    break;

  default:
    break;
}

echo ($soloCupsEncode);

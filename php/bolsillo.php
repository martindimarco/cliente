<?php
require '../vendor/autoload.php';

$cupsFromBolsilloJs = isset($_POST['cups']) ? $_POST['cups'] : "sin datos recibidos";
$tipoConsulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";



$connContracts = (new MongoDB\Client)->gdc->contracts;
$connFacturacion = (new MongoDB\Client)->Facturacion->ID_BolsilloSolar;

switch ($tipoConsulta) {
  case "datosDelSelect":
    $pointerContracts = $connContracts->find(
      ['codecom' => 'BOLSILLO SOLAR'],
      ['projection' =>
      [
        'sips' => 0,
        'crm' => 0,
        'erp' => 0,
        'Comisiones' => 0
      ]]
    );

    $cups = [];
    foreach ($pointerContracts as $show) {

      array_push($cups, $show);
    }
    $cupsEncode = json_encode($cups);
    break;
  case "cups":
    $pointerContracts = $connContracts->find(
      ['codecom' => 'BOLSILLO SOLAR', 'cups.code' => $cupsFromBolsilloJs],
      ['projection' =>
      [
        'sips' => 0,
        'crm' => 0,
        'erp' => 0,
        'Comisiones' => 0
      ]]
    );

    $cups = [];
    foreach ($pointerContracts as $show) {

      array_push($cups, $show);
      $cif = $show['client']['code'];
    }

    $pointerFacturacion = $connFacturacion->findOne(
      ['cif' => $cif]
    );

    $codigoAmigo = $pointerFacturacion['codigo_amigo'];

    $cups["codigoAmigo"] = $codigoAmigo;

    $cupsEncode = json_encode($cups);
    break;

  default:
    break;
};

echo ($cupsEncode);

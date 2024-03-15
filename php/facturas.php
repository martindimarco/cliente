<?php
session_start();
require '../vendor/autoload.php';

$valueFromIndexJs = isset($_POST['cups']) ? $_POST['cups'] : "sin datos recibidos";
$tipoConsulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$marca = isset($_POST['marca']) ? $_POST['marca'] : "";
$session_usuFromLogin = $_SESSION['usu']; 



$connContracts = (new MongoDB\Client)->gdc->contracts;
$connInvoices_ext = (new MongoDB\Client)->gdc->invoices_ext;

switch ($tipoConsulta) {
  case "datosDelSelect":
    $pointerContracts = $connContracts->find(['client.code' => $session_usuFromLogin]);
    $pointerInvoices_ext = $connInvoices_ext->find(['CIF' => $session_usuFromLogin]);

    $allDataFromContracts = [];
    $allDataFromInvoices_ext = [];

    foreach ($pointerContracts as $show) {
      // añadir un details end en vacio. 
        array_push($allDataFromContracts, $show);
    }

    foreach ($pointerInvoices_ext as $show) {
      array_push($allDataFromInvoices_ext, $show);
    }

    $allDataFromContractsAndInvoices_ext = ["contracts" => $allDataFromContracts, "invoices_ext" => $allDataFromInvoices_ext];

    $allDataFromIndex =  json_encode($allDataFromContractsAndInvoices_ext);
    break;

  case "cups":
    // $pointerContracts = $connContracts->find(['cups.code' => $valueFromIndexJs, 'codecom' => $marca]);
    $pointerContracts = $connContracts->find(['cups.code' => $valueFromIndexJs]);

    $dataFromCups = [];

    foreach ($pointerContracts as $show) {
      array_push($dataFromCups, $show);
    }
    $allDataFromIndex =  json_encode($dataFromCups);
    break;
}

echo $allDataFromIndex;

<?php
require '../vendor/autoload.php';



$connContracts = (new MongoDB\Client)->gdc->contracts;
$connTickets = (new MongoDB\Client)->gdc->tickets;

$pointerContracs = $connContracts->find(
  ['codecom' => 'BOLSILLO SOLAR'],
  ['projection' =>
  [
    'sips' => 0,
    'crm' => 0,
    'erp' => 0,
    'Comisiones' => 0
  ]]
);

$pointerTickets = $connTickets->find(
  ['cups' => 'ES0031406308607003CP0F']
);

$contracs = [];
$ticketsMsj = [];

foreach ($pointerContracs as $show) {
  array_push($contracs, $show);
};

foreach ($pointerTickets as $show) {
  array_push($ticketsMsj, $show);
};

$contractsAndTickets = ["contracts" => $contracs, "tickets" => $ticketsMsj];


$contractsAndTicketsjEncode = json_encode($contractsAndTickets);



echo($contractsAndTicketsjEncode);

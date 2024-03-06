<?php
require '../vendor/autoload.php';

$connContracts =  (new MongoDB\Client)->gdc->contracts;
$connContracts->createIndex(['cups.code' => 1]);
$pointerContracts = $connContracts->find();

// $start = microtime(true);
foreach ($pointerContracts as $showCups) {
  echo $showCups['cups']['code'] . '<br>';
}
// $end = microtime(true);

// echo '<br>';
// $metrica= $end -$start;
// print_r($metrica);



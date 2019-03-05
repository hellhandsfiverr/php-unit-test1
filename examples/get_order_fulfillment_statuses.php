<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$orderStatuses = $client->getAllOrderFulfillmentStatuses();
if($orderStatuses === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($orderStatuses);


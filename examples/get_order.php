<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$uri = 'https://api.giftango.com/orders/0G6-W6-WGK';

$order = $client->getOrder($uri);
if($order === null) {
    print_r($client->getErrors());
    exit;
}

print_r($order);


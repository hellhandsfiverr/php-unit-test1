<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

//use any of the uri's to retrieve order info
$uri = 'https://api.giftango.com/orders/1K4-BW-MTZ';

$order = $client->getOrder($uri);
if($order === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($order);


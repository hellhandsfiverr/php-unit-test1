<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

//use any of the uri's to retrieve order info
//https://api.giftango.com/orders/1K4-BW-MTZ
//https://api.giftango.com/orders/MV0-6C-57Q
//https://api.giftango.com/orders/3PH-7G-2S7
//https://api.giftango.com/orders/DD8-GF-FVW
//https://api.giftango.com/orders/5XK-L1-3J5
//https://api.giftango.com/orders/0G6-W6-WGK

$uri = 'https://api.giftango.com/orders/0G6-W6-WGK';

$order = $client->getOrder($uri);
if($order === null) {
    print_r($client->getErrors());
    exit;
}

print_r($order);


<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

//use any of the uri's to retrieve order info
$uri = 'https://api.giftango.com/orders/QPZ-4Q-GLS';
/*$uri = 'https://api.giftango.com/orders/B17-0D-DWZ';
$uri = 'https://api.giftango.com/orders/9T8-CP-2B0';
$uri = 'https://api.giftango.com/orders/S2S-R8-6CJ';
$uri = 'https://api.giftango.com/orders/G2N-D6-QRC';
$uri = 'https://api.giftango.com/orders/4HF-CV-ZXP';
$uri = 'https://api.giftango.com/orders/QX4-0J-JSX';*/

$orderCards = $client->getOrderCardsList($uri);
if($orderCards === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($orderCards);


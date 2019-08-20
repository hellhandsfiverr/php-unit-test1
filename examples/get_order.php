<?php
require __DIR__ . "/../vendor/autoload.php";

//Get Creds from Shared Lastpass
$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('');
$client->setClientSecret('');

$response = $client->getOrder('DEV-B4BV4KRLM');
if($response === null) {
    print_r($client->getErrors());
    exit;
}


<?php
require __DIR__ . "/../vendor/autoload.php";

//Get Creds from Shared Lastpass
$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('');
$client->setClientSecret('');

$token = $client->generateAuthToken();
if($token === null || $token === false) {
    print_r($client->getErrors());
    exit;
}

var_dump($token);


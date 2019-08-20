<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\Fitbit\Client;
$client->setClientId('DR30266');
$client->setClientSecret('8dcFRMKv3I3dILXRu8wKH1Wc6FTNHpUZXcEWK3TzemM');

$response = $client->cancelOrder('DEV-B4BV4KRLM');
if($response === false) {
    print_r($client->getErrors());
    exit;
}


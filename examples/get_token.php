<?php
require __DIR__ . "/../vendor/autoload.php";

/*
 * Client ID: DR30266
API Auth Secret: 8dcFRMKv3I3dILXRu8wKH1Wc6FTNHpUZXcEWK3TzemM
Notifications Auth Secret: ktpfiYRyxu1qK535Fr3xA88x8NhcIFpF7qKBDUka2HM
 */
$client = new \AllDigitalRewards\Vendor\Fitbit\Client;
$client->setClientId('DR30266');
$client->setClientSecret('8dcFRMKv3I3dILXRu8wKH1Wc6FTNHpUZXcEWK3TzemM');

$token = $client->generateAuthToken();
if($token === null || $token === false) {
    print_r($client->getErrors());
    exit;
}

var_dump($token);


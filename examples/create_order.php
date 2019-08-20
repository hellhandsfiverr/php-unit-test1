<?php
require __DIR__ . "/../vendor/autoload.php";

//Get Creds from Shared Lastpass
$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('');
$client->setClientSecret('');

$orderProduct = new \AllDigitalRewards\Vendor\Fitbit\Entities\OrderProduct(
    [
        "skuCode" => "412BKBK",
        "quantity" => 1
    ]
);

$recipient = new \AllDigitalRewards\Vendor\Fitbit\Entities\Recipient(
    [
        "name" => "Joseph Muto",
        "email" => "jmuto@alldigitalrewards.com",
        "phone" => "407-458-3861",
        "address1" => "935 Bungalow Ave",
        "address2" => "",
        "city" => "Winter Park",
        "state" => "FL",
        "postal" => "32789",
        "country" => "US"
    ]
);

$orderRequest = new \AllDigitalRewards\Vendor\Fitbit\Entities\OrderRequest(
    [
        "orderId" => "Customer11-22",
        "promoCode" => "DROPSHIP",
        "logoUrl" => "https://www.partner.com/logo.png",
        "companyName" => "partner name",
        "sendShipmentConfimation" => true,
    ]
);
$orderRequest->setLineItems([$orderProduct]);
$orderRequest->setShippingAddress($recipient);

$response = $client->createOrder($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($response);

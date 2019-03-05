<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\Fitbit\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$orderProduct = new \AllDigitalRewards\Vendor\Fitbit\Entities\OrderProduct(
    [
        "Sku" => "VUSD-D-V-00",
        "Value" => 25,
        "Quantity" => 1
    ]
);

$recipient = new \AllDigitalRewards\Vendor\Fitbit\Entities\Recipient(
    [
        "FirstName" => "Joseph",
        "LastName" => "Muto",
        "EmailAddress" => "jmuto@alldigitalrewards.com",
        "Address1" => "935 Bungalow Ave",
        "Address2" => "",
        "City" => "Winter Park",
        "StateProvinceCode" => "FL",
        "PostalCode" => "32789",
        "CountryCode" => "US"
    ]
);
$recipient->setProducts([$orderProduct]);
$orderRequest = new \AllDigitalRewards\Vendor\Fitbit\Entities\OrderRequest(
    [
        "CatalogId" => 1,
        "CustomerOrderId" => "Customer11-22"
    ]
);
$orderRequest->setRecipients([$recipient]);

$response = $client->createOrderLaterFulfillment($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($response);
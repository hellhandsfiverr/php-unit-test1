<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

// limited to five cards and one recipient per order
$orderProduct = new \AllDigitalRewards\Vendor\InComm\Entities\OrderProduct(
    [
        "Sku" => "VUSD-D-V-00",
        "Value" => 25,
        "Quantity" => 1,
    ]
);

$recipient = new \AllDigitalRewards\Vendor\InComm\Entities\Recipient(
    [
        "FirstName" => "Joseph",
        "LastName" => "Muto",
        "EmailAddress" => "jmuto@alldigitalrewards.com",
        "Address1" => "935 Bungalow Ave",
        "Address2" => "",
        "City" => "Winter Park",
        "StateProvinceCode" => "FL",
        "PostalCode" => "32789",
        "CountryCode" => "US",
    ]
);
$recipient->setProducts([$orderProduct]);
$orderRequest = new \AllDigitalRewards\Vendor\InComm\Entities\OrderRequest(
    [
        "CatalogId" => 1,
        "CustomerOrderId" => "Customer1-2",
    ]
);
$orderRequest->setRecipients([$recipient]);

if ($client->createImmediateOrder($orderRequest) === null) {
    print_r($client->getErrors());
    exit;
}

print_r($client->createImmediateOrder($orderRequest));
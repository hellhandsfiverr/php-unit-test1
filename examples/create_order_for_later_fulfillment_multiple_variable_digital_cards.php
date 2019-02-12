<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$orderProduct1 = new \AllDigitalRewards\Vendor\InComm\Entities\OrderProduct(
    [
        "Sku" => "VUSD-D-V-00",
        "Value" => 20,
        "Quantity" => 1,
    ]
);
$orderProduct2 = new \AllDigitalRewards\Vendor\InComm\Entities\OrderProduct(
    [
        "Sku" => "VUSA-D-2500-00",
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
$recipient->setProducts([$orderProduct1, $orderProduct2]);
$orderRequest = new \AllDigitalRewards\Vendor\InComm\Entities\OrderRequest(
    [
        "CatalogId" => 1,
        "CustomerOrderId" => "Customer2-2",
    ]
);
$orderRequest->setRecipients([$recipient]);

$response = $client->createOrderLaterFulfillment($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($response);
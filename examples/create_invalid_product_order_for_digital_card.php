<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$orderProduct = new \AllDigitalRewards\Vendor\InComm\Entities\OrderProduct(
    [
        "Sku" => "VQSA-R-250-09",
        "Value" => 10,
        "Quantity" => 1,
    ]
);

$recipient = new \AllDigitalRewards\Vendor\InComm\Entities\Recipient(
    [
        "FirstName" => "Joseph",
        "LastName" => "Muto",
        "EmailAddress" => "",
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
        "CustomerOrderId" => "Customer1-10",
    ]
);
$orderRequest->setRecipients([$recipient]);

$response = $client->createOrderLaterFulfillment($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

/*
Array
(
    [0] => EmailAddress is not valid
    [1] => Sku [VQSA-R-250-09] is not available for the specified program and catalog.
)
 */
var_dump($response);
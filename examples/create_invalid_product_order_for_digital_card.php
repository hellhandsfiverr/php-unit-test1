<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

$orderRequest = [
    "PurchaseOrderNumber" => "10",
    "CatalogId" => 1,
    "Metadata" => "",
    "CustomerOrderId" => "Customer1-10",
    "EmailTheme" => "",
    "Recipients" => [
        [
            "ShippingMethod" => "Email",
            "LanguageCultureCode" => "en-US",
            "FirstName" => "Joseph",
            "LastName" => "Muto",
            "EmailAddress" => "jmuto@alldigitalrewards.com",
            "Address1" => "935 Bungalow Ave",
            "Address2" => "",
            "City" => "Winter Park",
            "StateProvinceCode" => "FL",
            "PostalCode" => "32789",
            "CountryCode" => "US",
            "DeliverEmail" => true,
            "Products" => [
                [
                    "Sku" => "VQSA-R-250-09",
                    "Value" => 10,
                    "Quantity" => 1,
                    "Packaging" => "PCK-1",
                    "MessageText" => "some text",
                    "MessageRecipientName" => "Joe Muto"
                ]
            ]
        ]
    ]
];

$response = $client->createOrder($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

/*
Array
(
    [0] => Array
        (
            [0] => Sku [VQSA-R-250-09] is not available for the specified program and catalog.
        )

)
 */
var_dump($response);
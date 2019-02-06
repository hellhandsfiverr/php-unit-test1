<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

//Submit a standard order for a variable physical card
$orderRequest = [
    "PurchaseOrderNumber" => "5",
    "CatalogId" => 1,
    "Metadata" => "",
    "CustomerOrderId" => "Customer1-5",
    "EmailTheme" => "",
    "Recipients" => [
        [
            "ShippingMethod" => "USPSFirstClass",
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
                    "Sku" => "VUSD-P-V-00",
                    "Value" => 35,
                    "Quantity" => 1,
                    "EmbossedTextId" => 0,
                    "Packaging" => "PCK-1",
                    "MessageText" => "my physical order",
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

var_dump($response);
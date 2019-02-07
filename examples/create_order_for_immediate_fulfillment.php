<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

// limited to five cards and one recipient per order
$orderRequest = [
    "PurchaseOrderNumber" => "2",
    "CatalogId" => 1,
    "Metadata" => "",
    "CustomerOrderId" => "Customer1-2",
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
                    "Sku" => "VUSD-D-V-00",
                    "Value" => 25,
                    "Quantity" => 1,
                    "EmbossedTextId" => 0,
                    "Packaging" => "string",
                    "ImageCode" => "string",
                    "MessageText" => "my first order",
                    "MessageRecipientName" => "Joe Muto"
                ]
            ]
        ]
    ]
];
if ($client->createImmediateOrder($orderRequest) === null) {
    print_r($client->getErrors());
    exit;
}

print_r($client->createImmediateOrder($orderRequest));
<?php
require __DIR__ . "/../vendor/autoload.php";

$client = new \AllDigitalRewards\Vendor\InComm\Client();
$client->setClientId('alldigitalrewardstest');
$client->setClientSecret('R]+uJ2meoN(bhL/mfV&To?f|8nEWz+cG');
$client->setProgramId(5870);

//Submit a standard order for a digital voucher card
$orderRequest = [
    "PurchaseOrderNumber" => "3",
    "CatalogId" => 1,
    "Metadata" => "",
    "CustomerOrderId" => "Customer1-3",
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
                    "Sku" => "VUSA-P-V-00",
                    "Value" => 34,
                    "Quantity" => 1,
                    "Packaging" => "PCK-1",
                    "MessageText" => "my 3rd order",
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
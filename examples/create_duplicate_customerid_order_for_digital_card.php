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
                    "Sku" => "VUSD-D-V-00",
                    "Value" => 25,
                    "Quantity" => 1,
                    "EmbossedTextId" => 0,
                    "MessageText" => "my first order",
                    "MessageRecipientName" => "Joe Muto"
                ]
            ]
        ]
    ]
];

//https://api.giftango.com/orders/3NG-M9-2N4
/*
 * 2nd attempt
 * Array
(
    [0] => Duplicate CustomerOrderId detected in order
)
 */

$response = $client->createOrder($orderRequest);
if ($response === null) {
    print_r($client->getErrors());
    exit;
}

var_dump($response);
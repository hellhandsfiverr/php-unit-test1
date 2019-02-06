<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;


class OrderRequest extends AbstractEntity
{
    /**
     * @var string
     */
    private $PurchaseOrderNumber;
    /**
     * @var int
     */
    private $CatalogId;
    /**
     * @var string
     */
    private $Metadata;
    /**
     * @var string
     */
    private $CustomerOrderId;
    /**
     * @var string
     */
    private $EmailTheme;
    /**
     * @var array
     */
    private $Recipients;

    /*$orderRequest = [
    "PurchaseOrderNumber" => "4",
    "CatalogId" => 1,
    "Metadata" => "",
    "CustomerOrderId" => "Customer1-4",
    "EmailTheme" => "",
    "Recipients" => [
        [
            "ShippingMethod" => "email",
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
                    "MessageText" => "my multi order",
                    "MessageRecipientName" => "Joe Muto"
                ],
                [
                    "Sku" => "VUSD-D-V-00",
                    "Value" => 25,
                    "Quantity" => 1,
                    "EmbossedTextId" => 0,
                    "Packaging" => "string",
                    "ImageCode" => "string",
                    "MessageText" => "my multi order",
                    "MessageRecipientName" => "Joe Muto"
                ]
            ]
        ]
    ]
];*/
}
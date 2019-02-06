<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderStatus extends AbstractEntity
{
    /**
     * @var string
     */
    private $FulfillmentStatus;
    /**
     * @var string
     */
    private $OrderUri;
    /**
     * @var string
     */
    private $CustomerOrderId;
    /**
     * @var string
     */
    private $OrderDate;
    /**
     * @var string
     */
    private $FulfilledDate;
    /**
     * @var string
     */
    private $Sku;
    /**
     * @var float
     */
    private $Value;
    /**
     * @var int
     */
    private $Quantity;

    /**
     * @return string
     */
    public function getFulfillmentStatus(): string
    {
        return $this->FulfillmentStatus;
    }

    /**
     * @param string $FulfillmentStatus
     */
    public function setFulfillmentStatus(string $FulfillmentStatus)
    {
        $this->FulfillmentStatus = $FulfillmentStatus;
    }

    /**
     * @return string
     */
    public function getOrderUri(): string
    {
        return $this->OrderUri;
    }

    /**
     * @param string $OrderUri
     */
    public function setOrderUri(string $OrderUri)
    {
        $this->OrderUri = $OrderUri;
    }

    /**
     * @return string
     */
    public function getCustomerOrderId(): string
    {
        return $this->CustomerOrderId;
    }

    /**
     * @param string $CustomerOrderId
     */
    public function setCustomerOrderId(string $CustomerOrderId)
    {
        $this->CustomerOrderId = $CustomerOrderId;
    }

    /**
     * @return string
     */
    public function getOrderDate(): string
    {
        return $this->OrderDate;
    }

    /**
     * @param string $OrderDate
     */
    public function setOrderDate(string $OrderDate)
    {
        $this->OrderDate = $OrderDate;
    }

    /**
     * @return string
     */
    public function getFulfilledDate(): string
    {
        return $this->FulfilledDate;
    }

    /**
     * @param string $FulfilledDate
     */
    public function setFulfilledDate(string $FulfilledDate)
    {
        $this->FulfilledDate = $FulfilledDate;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->Sku;
    }

    /**
     * @param string $Sku
     */
    public function setSku(string $Sku)
    {
        $this->Sku = $Sku;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->Value;
    }

    /**
     * @param float $Value
     */
    public function setValue(float $Value)
    {
        $this->Value = $Value;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->Quantity;
    }

    /**
     * @param int $Quantity
     */
    public function setQuantity(int $Quantity)
    {
        $this->Quantity = $Quantity;
    }
}
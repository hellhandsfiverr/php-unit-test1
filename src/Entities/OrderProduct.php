<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderProduct extends AbstractEntity
{
    /**
     * @var string
     */
    protected $Sku;
    /**
     * @var float
     */
    protected $Value;
    /**
     * @var int
     */
    protected $Quantity;

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
<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderProduct extends AbstractEntity
{
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
     * @var int
     */
    private $EmbossedTextId;
    /**
     * @var string
     */
    private $Packaging;
    /**
     * @var string
     */
    private $ImageCode;
    /**
     * @var string
     */
    private $MessageText;
    /**
     * @var string
     */
    private $MessageRecipientName;

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

    /**
     * @return int
     */
    public function getEmbossedTextId(): int
    {
        return $this->EmbossedTextId;
    }

    /**
     * @param int $EmbossedTextId
     */
    public function setEmbossedTextId(int $EmbossedTextId)
    {
        $this->EmbossedTextId = $EmbossedTextId;
    }

    /**
     * @return string
     */
    public function getPackaging(): string
    {
        return $this->Packaging;
    }

    /**
     * @param string $Packaging
     */
    public function setPackaging(string $Packaging)
    {
        $this->Packaging = $Packaging;
    }

    /**
     * @return string
     */
    public function getImageCode(): string
    {
        return $this->ImageCode;
    }

    /**
     * @param string $ImageCode
     */
    public function setImageCode(string $ImageCode)
    {
        $this->ImageCode = $ImageCode;
    }

    /**
     * @return string
     */
    public function getMessageText(): string
    {
        return $this->MessageText;
    }

    /**
     * @param string $MessageText
     */
    public function setMessageText(string $MessageText)
    {
        $this->MessageText = $MessageText;
    }

    /**
     * @return string
     */
    public function getMessageRecipientName(): string
    {
        return $this->MessageRecipientName;
    }

    /**
     * @param string $MessageRecipientName
     */
    public function setMessageRecipientName(string $MessageRecipientName)
    {
        $this->MessageRecipientName = $MessageRecipientName;
    }
}
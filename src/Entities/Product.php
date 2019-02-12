<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class Product extends AbstractEntity
{
    /**
     * @var string
     */
    protected $productName;
    /**
     * @var int
     */
    protected $catalogId;

    /**
     * @var string
     */
    protected $brandName;

    /**
     * @var string
     */
    protected $productSku;

    /**
     * @var bool
     */
    protected $isDigital;

    /**
     * @var int
     */
    protected $maxAmount;

    /**
     * @var int
     */
    protected $minAmount;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $productType;

    /**
     * @var string|null
     */
    protected $term_attachment;

    /**
     * @var string|null
     */
    protected $disclosure;

    /**
     * @var string|null
     */
    protected $terms;

    /**
     * @var string|null
     */
    protected $image;

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getCatalogId(): int
    {
        return $this->catalogId;
    }

    /**
     * @param int $catalogId
     */
    public function setCatalogId(int $catalogId)
    {
        $this->catalogId = $catalogId;
    }

    /**
     * @return string
     */
    public function getBrandName(): string
    {
        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName(string $brandName): void
    {
        $this->brandName = $brandName;
    }

    /**
     * @return string
     */
    public function getProductSku(): string
    {
        return $this->productSku;
    }

    /**
     * @param string $productSku
     */
    public function setProductSku(string $productSku): void
    {
        $this->productSku = $productSku;
    }

    /**
     * @return bool
     */
    public function isDigital(): bool
    {
        return $this->isDigital;
    }

    /**
     * @param bool $isDigital
     */
    public function setIsDigital(bool $isDigital)
    {
        $this->isDigital = $isDigital;
    }

    /**
     * @return int
     */
    public function getMaxAmount(): int
    {
        return $this->maxAmount;
    }

    /**
     * @param int $maxAmount
     */
    public function setMaxAmount(int $maxAmount): void
    {
        $this->maxAmount = $maxAmount;
    }

    /**
     * @return int
     */
    public function getMinAmount(): int
    {
        return $this->minAmount;
    }

    /**
     * @param int $minAmount
     */
    public function setMinAmount(int $minAmount): void
    {
        $this->minAmount = $minAmount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getProductType(): string
    {
        return $this->productType;
    }

    /**
     * @param string $productType
     */
    public function setProductType(string $productType): void
    {
        $this->productType = $productType;
    }

    /**
     * @return string|null
     */
    public function getTermAttachment(): ?string
    {
        return $this->term_attachment;
    }

    /**
     * @param string|null $term_attachment
     */
    public function setTermAttachment(?string $term_attachment): void
    {
        $this->term_attachment = $term_attachment;
    }

    /**
     * @return string|null
     */
    public function getDisclosure(): ?string
    {
        return $this->disclosure;
    }

    /**
     * @param string|null $disclosure
     */
    public function setDisclosure(?string $disclosure): void
    {
        $this->disclosure = $disclosure;
    }

    /**
     * @return string|null
     */
    public function getTerms(): ?string
    {
        return $this->terms;
    }

    /**
     * @param string|null $terms
     */
    public function setTerms(?string $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}

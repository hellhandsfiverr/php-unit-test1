<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderCard extends AbstractEntity
{
    /**
     * @var string
     */
    protected $CertificateLink;
    /**
     * @var string
     */
    protected $CardNumber;
    /**
     * @var string
     */
    protected $Pin;
    /**
     * @var string
     */
    protected $BarcodeImageUrl;
    /**
     * @var string
     */
    protected $CardUri;
    /**
     * @var string
     */
    protected $Sku;
    /**
     * @var float
     */
    protected $InitialBalance;
    /**
     * @var string
     */
    protected $CreatedOn;
    /**
     * @var string
     */
    protected $ImageUrl;
    /**
     * @var string
     */
    protected $TermsAndConditions;
    /**
     * @var string
     */
    protected $UsageInstructions;

    /**
     * @return string
     */
    public function getCertificateLink(): string
    {
        return $this->CertificateLink;
    }

    /**
     * @param string $CertificateLink
     */
    public function setCertificateLink(string $CertificateLink)
    {
        $this->CertificateLink = $CertificateLink;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->CardNumber;
    }

    /**
     * @param string $CardNumber
     */
    public function setCardNumber(string $CardNumber)
    {
        $this->CardNumber = $CardNumber;
    }

    /**
     * @return string
     */
    public function getPin(): string
    {
        return $this->Pin;
    }

    /**
     * @param string $Pin
     */
    public function setPin(string $Pin)
    {
        $this->Pin = $Pin;
    }

    /**
     * @return string
     */
    public function getBarcodeImageUrl(): string
    {
        return $this->BarcodeImageUrl;
    }

    /**
     * @param string $BarcodeImageUrl
     */
    public function setBarcodeImageUrl(string $BarcodeImageUrl)
    {
        $this->BarcodeImageUrl = $BarcodeImageUrl;
    }

    /**
     * @return string
     */
    public function getCardUri(): string
    {
        return $this->CardUri;
    }

    /**
     * @param string $CardUri
     */
    public function setCardUri(string $CardUri)
    {
        $this->CardUri = $CardUri;
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
    public function getInitialBalance(): float
    {
        return $this->InitialBalance;
    }

    /**
     * @param float $InitialBalance
     */
    public function setInitialBalance(float $InitialBalance)
    {
        $this->InitialBalance = $InitialBalance;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->CreatedOn;
    }

    /**
     * @param string $CreatedOn
     */
    public function setCreatedOn(string $CreatedOn)
    {
        $this->CreatedOn = $CreatedOn;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->ImageUrl;
    }

    /**
     * @param string $ImageUrl
     */
    public function setImageUrl(string $ImageUrl)
    {
        $this->ImageUrl = $ImageUrl;
    }

    /**
     * @return string
     */
    public function getTermsAndConditions(): string
    {
        return $this->TermsAndConditions;
    }

    /**
     * @param string $TermsAndConditions
     */
    public function setTermsAndConditions(string $TermsAndConditions)
    {
        $this->TermsAndConditions = $TermsAndConditions;
    }

    /**
     * @return string
     */
    public function getUsageInstructions(): string
    {
        return $this->UsageInstructions;
    }

    /**
     * @param string $UsageInstructions
     */
    public function setUsageInstructions(string $UsageInstructions)
    {
        $this->UsageInstructions = $UsageInstructions;
    }
}

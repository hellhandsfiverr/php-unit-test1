<?php

namespace AllDigitalRewards\Vendor\Fitbit\Entities;

class OrderRequest extends AbstractEntity
{
    /**
     * @var string
     */
    protected $orderId;
    /**
     * @var OrderProduct[]
     */
    protected $lineItems;
    /**
     * @var string
     */
    protected $promoCode;
    /**
     * @var string
     */
    protected $logoUrl;
    /**
     * @var string
     */
    protected $companyName;
    /**
     * @var bool
     */
    protected $sendOrderConfirmation = false;
    /**
     * @var bool
     */
    protected $sendShipmentConfimation = true;
    /**
     * @var bool
     */
    protected $showPricingInEmails = false;
    /**
     * @var Recipient
     */
    protected $shippingAddress;

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return OrderProduct[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param OrderProduct[] $lineItems
     */
    public function setLineItems(array $lineItems): void
    {
        $this->lineItems = $lineItems;
    }

    /**
     * @return string
     */
    public function getPromoCode(): string
    {
        return $this->promoCode;
    }

    /**
     * @param string $promoCode
     */
    public function setPromoCode(string $promoCode): void
    {
        $this->promoCode = $promoCode;
    }

    /**
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    /**
     * @param string $logoUrl
     */
    public function setLogoUrl(string $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * @return bool
     */
    public function isSendOrderConfirmation(): bool
    {
        return $this->sendOrderConfirmation;
    }

    /**
     * @param bool $sendOrderConfirmation
     */
    public function setSendOrderConfirmation(bool $sendOrderConfirmation): void
    {
        $this->sendOrderConfirmation = $sendOrderConfirmation;
    }

    /**
     * @return bool
     */
    public function isSendShipmentConfimation(): bool
    {
        return $this->sendShipmentConfimation;
    }

    /**
     * @param bool $sendShipmentConfimation
     */
    public function setSendShipmentConfimation(bool $sendShipmentConfimation): void
    {
        $this->sendShipmentConfimation = $sendShipmentConfimation;
    }

    /**
     * @return bool
     */
    public function isShowPricingInEmails(): bool
    {
        return $this->showPricingInEmails;
    }

    /**
     * @param bool $showPricingInEmails
     */
    public function setShowPricingInEmails(bool $showPricingInEmails): void
    {
        $this->showPricingInEmails = $showPricingInEmails;
    }

    /**
     * @return Recipient
     */
    public function getShippingAddress(): Recipient
    {
        return $this->shippingAddress;
    }

    /**
     * @param Recipient $shippingAddress
     */
    public function setShippingAddress(Recipient $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        if ($data['lineItems']) {
            $products = [];
            foreach ($data['lineItems'] as $orderProduct) {
                $products[] = $orderProduct->toArray();
            }
            $data['lineItems'] = $products;
        }
        if ($data['shippingAddress']) {
            $data['shippingAddress'] = $data['shippingAddress']->toArray();
        }

        return $data;
    }
}

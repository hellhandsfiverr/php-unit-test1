<?php

namespace AllDigitalRewards\Vendor\Fitbit\Entities;

class OrderStatus extends AbstractEntity
{
    /**
     * @var array
     */
    protected $skuStatuses;
    /**
     * @var string
     */
    protected $orderUrl;
    /**
     * @var string
     */
    protected $orderConfirmationNumber;
    /**
     * @var string
     */
    protected $orderStatus;
    /**
     * @var mixed
     */
    protected $shippingMethod;
    /**
     * @var array
     */
    protected $itemsAwaitingShipment;
    /**
     * @var array
     */
    protected $shipments;

    /**
     * @return array
     */
    public function getSkuStatuses(): array
    {
        return $this->skuStatuses;
    }

    /**
     * @param array $skuStatuses
     */
    public function setSkuStatuses(array $skuStatuses): void
    {
        $this->skuStatuses = $skuStatuses;
    }

    /**
     * @return string
     */
    public function getOrderUrl(): string
    {
        return $this->orderUrl;
    }

    /**
     * @param string $orderUrl
     */
    public function setOrderUrl(string $orderUrl): void
    {
        $this->orderUrl = $orderUrl;
    }

    /**
     * @return string
     */
    public function getOrderConfirmationNumber(): string
    {
        return $this->orderConfirmationNumber;
    }

    /**
     * @param string $orderConfirmationNumber
     */
    public function setOrderConfirmationNumber(string $orderConfirmationNumber): void
    {
        $this->orderConfirmationNumber = $orderConfirmationNumber;
    }

    /**
     * @return string
     */
    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }

    /**
     * @param string $orderStatus
     */
    public function setOrderStatus(string $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return mixed
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * @param mixed $shippingMethod
     */
    public function setShippingMethod($shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * @return array
     */
    public function getItemsAwaitingShipment(): array
    {
        return $this->itemsAwaitingShipment;
    }

    /**
     * @param array $itemsAwaitingShipment
     */
    public function setItemsAwaitingShipment(array $itemsAwaitingShipment): void
    {
        $this->itemsAwaitingShipment = $itemsAwaitingShipment;
    }

    /**
     * @return array
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * @param array $shipments
     */
    public function setShipments(array $shipments): void
    {
        $this->shipments = $shipments;
    }
}

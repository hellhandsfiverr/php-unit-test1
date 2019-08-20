<?php

namespace AllDigitalRewards\Vendor\Fitbit\Entities;

class OrderResponse extends AbstractEntity
{
    /**
     * @var string
     */
    protected $orderId;
    /**
     * @var OrderStatus
     */
    protected $orderStatus;
    /**
     * @var mixed
     */
    protected $error;

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
     * @return OrderStatus
     */
    public function getOrderStatus(): OrderStatus
    {
        return $this->orderStatus;
    }

    /**
     * @param OrderStatus $orderStatus
     */
    public function setOrderStatus(OrderStatus $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }
}

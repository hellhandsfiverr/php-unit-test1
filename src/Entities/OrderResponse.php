<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderResponse extends AbstractEntity
{
    /**
     * @var string
     */
    private $OrderUri;
    /**
     * @var string
     */
    private $CreatedOn;
    /**
     * @var string
     */
    private $OrderStatus;
    /**
     * @var string
     */
    private $Message;
    /**
     * @var string
     */
    private $PurchaseOrderNumber;
    /**
     * @var int
     */
    private $ProgramId;
    /**
     * @var int
     */
    private $CatalogId;
    /**
     * @var float
     */
    private $TotalFaceValue;
    /**
     * @var float
     */
    private $TotalFees;
    /**
     * @var float
     */
    private $TotalDiscounts;
    /**
     * @var float
     */
    private $TotalCustomerCost;
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
    public function getOrderStatus(): string
    {
        return $this->OrderStatus;
    }

    /**
     * @param string $OrderStatus
     */
    public function setOrderStatus(string $OrderStatus)
    {
        $this->OrderStatus = $OrderStatus;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->Message;
    }

    /**
     * @param string $Message
     */
    public function setMessage(string $Message)
    {
        $this->Message = $Message;
    }

    /**
     * @return string
     */
    public function getPurchaseOrderNumber(): string
    {
        return $this->PurchaseOrderNumber;
    }

    /**
     * @param string $PurchaseOrderNumber
     */
    public function setPurchaseOrderNumber(string $PurchaseOrderNumber)
    {
        $this->PurchaseOrderNumber = $PurchaseOrderNumber;
    }

    /**
     * @return int
     */
    public function getProgramId(): int
    {
        return $this->ProgramId;
    }

    /**
     * @param int $ProgramId
     */
    public function setProgramId(int $ProgramId)
    {
        $this->ProgramId = $ProgramId;
    }

    /**
     * @return int
     */
    public function getCatalogId(): int
    {
        return $this->CatalogId;
    }

    /**
     * @param int $CatalogId
     */
    public function setCatalogId(int $CatalogId)
    {
        $this->CatalogId = $CatalogId;
    }

    /**
     * @return float
     */
    public function getTotalFaceValue(): float
    {
        return $this->TotalFaceValue;
    }

    /**
     * @param float $TotalFaceValue
     */
    public function setTotalFaceValue(float $TotalFaceValue)
    {
        $this->TotalFaceValue = $TotalFaceValue;
    }

    /**
     * @return float
     */
    public function getTotalFees(): float
    {
        return $this->TotalFees;
    }

    /**
     * @param float $TotalFees
     */
    public function setTotalFees(float $TotalFees)
    {
        $this->TotalFees = $TotalFees;
    }

    /**
     * @return float
     */
    public function getTotalDiscounts(): float
    {
        return $this->TotalDiscounts;
    }

    /**
     * @param float $TotalDiscounts
     */
    public function setTotalDiscounts(float $TotalDiscounts)
    {
        $this->TotalDiscounts = $TotalDiscounts;
    }

    /**
     * @return float
     */
    public function getTotalCustomerCost(): float
    {
        return $this->TotalCustomerCost;
    }

    /**
     * @param float $TotalCustomerCost
     */
    public function setTotalCustomerCost(float $TotalCustomerCost)
    {
        $this->TotalCustomerCost = $TotalCustomerCost;
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
    public function getEmailTheme(): string
    {
        return $this->EmailTheme;
    }

    /**
     * @param string $EmailTheme
     */
    public function setEmailTheme(string $EmailTheme)
    {
        $this->EmailTheme = $EmailTheme;
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->Recipients;
    }

    /**
     * @param array $Recipients
     */
    public function setRecipients(array $Recipients)
    {
        if (empty($Recipients) === true) {
            $this->Recipients = [];
            return;
        }

        foreach ($Recipients as $key => $recipient) {
            $products = $recipient['Products'];
            unset($recipient['Products']);
            $this->Recipients[] = new Recipient($recipient);
            foreach ($products as $product) {
                $this->Recipients['Products'][] = new OrderProduct($product);
            }
        }
    }
}

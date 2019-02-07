<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class OrderRequest extends AbstractEntity
{
    /**
     * @var int
     */
    protected $CatalogId;
    /**
     * @var string
     */
    protected $CustomerOrderId;
    /**
     * @var Recipient[]
     */
    protected $Recipients;

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
     * @return Recipient[]
     */
    public function getRecipients(): array
    {
        return $this->Recipients;
    }

    /**
     * @param Recipient[] $Recipients
     */
    public function setRecipients(array $Recipients)
    {
        $this->Recipients = $Recipients;
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        if ($data['Recipients']) {
            $recipients = [];
            foreach ($data['Recipients'] as $recipient) {
                $recipients[] = $recipient->toArray();
            }
            $data['Recipients'] = $recipients;
        }

        return $data;
    }
}

<?php

namespace AllDigitalRewards\Vendor\Fitbit\Entities;

class Recipient extends AbstractEntity
{
    /**
     * @var string
     */
    protected $ShippingMethod = 'Email';
    /**
     * @var string
     */
    protected $LanguageCultureCode = 'en-US';
    /**
     * @var string
     */
    protected $FirstName;
    /**
     * @var string
     */
    protected $LastName;
    /**
     * @var string
     */
    protected $EmailAddress;
    /**
     * @var string
     */
    protected $Address1;
    /**
     * @var string
     */
    protected $Address2;
    /**
     * @var string
     */
    protected $City;
    /**
     * @var string
     */
    protected $StateProvinceCode;
    /**
     * @var string
     */
    protected $PostalCode;
    /**
     * @var string
     */
    protected $CountryCode;
    /**
     * @var bool
     */
    protected $DeliverEmail = false;
    /**
     * @var OrderProduct[]
     */
    protected $Products;

    /**
     * @return string
     */
    public function getShippingMethod(): string
    {
        return $this->ShippingMethod;
    }

    /**
     * @param string $ShippingMethod
     */
    public function setShippingMethod(string $ShippingMethod)
    {
        $this->ShippingMethod = $ShippingMethod;
    }

    /**
     * @return string
     */
    public function getLanguageCultureCode(): string
    {
        return $this->LanguageCultureCode;
    }

    /**
     * @param string $LanguageCultureCode
     */
    public function setLanguageCultureCode(string $LanguageCultureCode)
    {
        $this->LanguageCultureCode = $LanguageCultureCode;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->FirstName;
    }

    /**
     * @param string $FirstName
     */
    public function setFirstName(string $FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->LastName;
    }

    /**
     * @param string $LastName
     */
    public function setLastName(string $LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->EmailAddress;
    }

    /**
     * @param string $EmailAddress
     */
    public function setEmailAddress(string $EmailAddress)
    {
        $this->EmailAddress = $EmailAddress;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->Address1;
    }

    /**
     * @param string $Address1
     */
    public function setAddress1(string $Address1)
    {
        $this->Address1 = $Address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->Address2;
    }

    /**
     * @param string $Address2
     */
    public function setAddress2(string $Address2)
    {
        $this->Address2 = $Address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->City;
    }

    /**
     * @param string $City
     */
    public function setCity(string $City)
    {
        $this->City = $City;
    }

    /**
     * @return string
     */
    public function getStateProvinceCode(): string
    {
        return $this->StateProvinceCode;
    }

    /**
     * @param string $StateProvinceCode
     */
    public function setStateProvinceCode(string $StateProvinceCode)
    {
        $this->StateProvinceCode = $StateProvinceCode;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->PostalCode;
    }

    /**
     * @param string $PostalCode
     */
    public function setPostalCode(string $PostalCode)
    {
        $this->PostalCode = $PostalCode;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->CountryCode;
    }

    /**
     * @param string $CountryCode
     */
    public function setCountryCode(string $CountryCode)
    {
        if (in_array($CountryCode, [840, 'us', 'US']) === true) {
            $this->CountryCode = 'US';
            return;
        }
        $this->CountryCode = $CountryCode;
    }

    /**
     * @return bool
     */
    public function isDeliverEmail(): bool
    {
        return $this->DeliverEmail;
    }

    /**
     * @param bool $DeliverEmail
     */
    public function setDeliverEmail(bool $DeliverEmail)
    {
        $this->DeliverEmail = $DeliverEmail;
    }

    /**
     * @return OrderProduct[]
     */
    public function getProducts(): array
    {
        return $this->Products;
    }

    /**
     * @param OrderProduct[] $Products
     */
    public function setProducts(array $Products)
    {
        $this->Products = $Products;
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        if ($data['Products']) {
            $products = [];
            foreach ($data['Products'] as $product) {
                $products[] = $product->toArray();
            }
            $data['Products'] = $products;
        }

        return $data;
    }
}

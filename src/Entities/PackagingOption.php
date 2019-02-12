<?php

namespace AllDigitalRewards\Vendor\InComm\Entities;

class PackagingOption extends AbstractEntity
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $lastModified;
    /**
     * @var array
     */
    protected $validForProducts;
    /**
     * @var array
     */
    protected $validForProductTypes;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastModified(): string
    {
        return $this->lastModified;
    }

    /**
     * @param string $lastModified
     */
    public function setLastModified(string $lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @return array
     */
    public function getValidForProducts(): array
    {
        return $this->validForProducts;
    }

    /**
     * @param array $validForProducts
     */
    public function setValidForProducts(array $validForProducts)
    {
        $this->validForProducts = $validForProducts;
    }

    /**
     * @return array
     */
    public function getValidForProductTypes(): array
    {
        return $this->validForProductTypes;
    }

    /**
     * @param array $validForProductTypes
     */
    public function setValidForProductTypes(array $validForProductTypes)
    {
        $this->validForProductTypes = $validForProductTypes;
    }
}

<?php

namespace AllDigitalRewards\Vendor\Fitbit\Entities;

class AuthTokenRequest extends AbstractEntity
{
    /**
     * @var string
     */
    protected $grant_type = 'client_credentials';

    /**
     * @var string
     */
    protected $client_id;

    /**
     * @var string
     */
    protected $client_secret;

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grant_type;
    }

    /**
     * @param string $grant_type
     */
    public function setGrantType(string $grant_type): void
    {
        $this->grant_type = $grant_type;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }
}

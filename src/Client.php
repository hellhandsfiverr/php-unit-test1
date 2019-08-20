<?php

namespace AllDigitalRewards\Vendor\Fitbit;

use AllDigitalRewards\Vendor\Fitbit\Entities\OrderRequest;
use AllDigitalRewards\Vendor\Fitbit\Entities\OrderResponse;

class Client
{
    /**
     * @var string
     */
    private $apiUrl = 'http://www.fitbit.com';
    /**
     * @var string
     */
    private $basePath = 'http://www.fitbit.com/cart/v2/dropship';
    /**
     * @var string
     */
    private $clientId;
    /**
     * @var string
     */
    private $clientSecret;
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;
    /**
     * @var string|null
     */
    private $authToken;
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var int
     */
    private $statusCode;

    /**
     * Client constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    private function getHttpClient(): \GuzzleHttp\Client
    {
        if ($this->httpClient === null) {
            $this->httpClient = new \GuzzleHttp\Client;
        }

        return $this->httpClient;
    }

    /**
     * @param \GuzzleHttp\Client $httpClient
     */
    public function setHttpClient(\GuzzleHttp\Client $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return bool
     */
    public function generateAuthToken(): bool
    {
        $url = $this->getApiUrl() . '/cart/oauth/token';

        try {
            $response = $this->getHttpClient()->post($url, [
                'debug' => false,
                'headers' => $this->getAuthHeaders()
            ]);
            $response = $response->getBody()->getContents();
            $decodedResponse = json_decode($response, true);

            if (is_array($decodedResponse) === false) {
                $this->errors[] = 'Unable to decode API auth token endpoint';
                return false;
            }

            $this->authToken = $decodedResponse['access_token'];
            return true;
        } catch (\Exception $exception) {
            $this->errors[] = $exception->getMessage();
            return false;
        }
    }

    /**
     * @return array
     */
    private function getAuthHeaders(): array
    {
        return [
            'Authorization' => "Basic {$this->getCredentials()}",
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded'
        ];
    }

    /**
     * @return string
     */
    private function getCredentials(): string
    {
        return base64_encode("{$this->getClientId()}:{$this->getClientSecret()}");
    }

    /**
     * @return null
     * @throws \Exception
     */
    private function getAuthToken()
    {
        if ($this->authToken === null) {
            $this->generateAuthToken();
        }

        return $this->authToken;
    }

    /**
     * @param OrderRequest $orderRequest
     * @return string|null
     */
    public function createOrder(OrderRequest $orderRequest): ?string
    {
        $url = $this->getApiUrl() . '/orders';

        $response = $this->sendRequest('POST', $url, $orderRequest);
        if ($this->statusCode === 200) {
            return $response->getHeader('Location')[0];
        }

        return null;
    }

    /**
     * @param string $confirmationNumber
     * @return OrderResponse|null
     */
    public function getOrder(string $confirmationNumber)
    {
        $url = $this->getApiUrl() . '/orders/' . $confirmationNumber;

        $response = $this->sendRequest('GET', $url);
        if ($this->statusCode === 200) {
            $jsonObj = json_decode($response->getBody(), true);
            return new OrderResponse($jsonObj);
        }

        return null;
    }

    /**
     * @param string $confirmationNumber
     * @return bool
     */
    public function cancelOrder(string $confirmationNumber): bool
    {
        $url = $this->getApiUrl() . '/orders/' . $confirmationNumber;

        $response = $this->sendRequest('DELETE', $url);
        if ($this->statusCode === 200) {
            return true;
        }

        return false;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param $type
     * @param $url
     * @param null $body
     * @return mixed|null
     */
    private function sendRequest($type, $url, $body = null)
    {
        try {
            if (($authToken = $this->getAuthToken()) === null) {
                $this->statusCode = 500;
                return null;
            }

            $response = $this->getHttpClient()->request(
                $type,
                $url,
                [
                    'headers' => [
                        'Authorization' => $authToken,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode($body)
                ]
            );

            $this->statusCode = $response->getStatusCode();
            if ($this->statusCode >= 200 && $this->statusCode <= 299) {
                return $response;
            }

            $jsonObj = json_decode($response->getBody(), true);
            $this->buildErrorsArray($jsonObj);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
        return null;
    }

    private function buildErrorsArray($arr)
    {
        if (!is_array($arr)) {
            //sometimes comes back NULL
            $this->errors[] = $arr ?? 'No error message available.';
            return;
        }
        foreach ($arr as $k => $v) {
            $this->buildErrorsArray($v);
        }
    }
}

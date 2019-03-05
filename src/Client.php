<?php

namespace AllDigitalRewards\Vendor\Fitbit;

use AllDigitalRewards\Vendor\Fitbit\Entities\OrderRequest;
use AllDigitalRewards\Vendor\Fitbit\Entities\OrderResponse;
use GuzzleHttp\Exception\RequestException;

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
     * @throws \Exception
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
                throw new \Exception('Unable to decode API auth token endpoint');
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
        try {
            $url = $this->getApiUrl() . '/orders';

            $response = $this->getHttpClient()->post($url, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                ],
                'body' => json_encode($orderRequest->toArray())
            ]);

            if ($response->getStatusCode() === 202) {
                return $response->getHeader('Location')[0];
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    /**
     * @param string $uri
     * @return OrderResponse|null
     */
    public function getOrder(string $uri)
    {
        try {
            $response = $this->getHttpClient()->get($uri, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $order = json_decode($response->getBody(), true);
                return new OrderResponse($order);
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param RequestException $e
     */
    private function setRequestExceptionError(RequestException $e)
    {
        $response = $e->getResponse()->getBody()->getContents();
        $errors = json_decode($response, true);
        $this->buildErrorsArray($errors);
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

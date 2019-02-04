<?php

namespace AllDigitalRewards\Vendor\InComm;

use AllDigitalRewards\Vendor\InComm\Entities\AuthTokenRequest;
use AllDigitalRewards\Vendor\InComm\Entities\PackagingOption;
use AllDigitalRewards\Vendor\InComm\Entities\Product;
use AllDigitalRewards\Vendor\InComm\Entities\Catalog;
use GuzzleHttp\Exception\RequestException;

class Client
{
    /**
     * @var string
     */
    private $tokenUrl = 'https://api.giftango.com';

    private $apiUrl = 'https://app.giftango.com';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var int
     */
    private $programId;

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
    private $productCollection = [];

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
    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    /**
     * @param string $tokenUrl
     */
    public function setTokenUrl(string $tokenUrl): void
    {
        $this->tokenUrl = $tokenUrl;
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

    /**
     * @return int
     */
    public function getProgramId(): int
    {
        return $this->programId;
    }

    /**
     * @param int $programId
     */
    public function setProgramId(int $programId): void
    {
        $this->programId = $programId;
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

    private function getAuthTokenRequest(): AuthTokenRequest
    {
        $authRequest = new AuthTokenRequest;
        $authRequest->setClientId($this->getClientId());
        $authRequest->setClientSecret($this->getClientSecret());

        return $authRequest;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function generateAuthToken(): bool
    {
        $url = $this->getTokenUrl() . '/auth/token';
        $response = $this->getHttpClient()->post($url, [
            'debug' => false,
            'form_params' => $this->getAuthTokenRequest()->toArray(),
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ]);
        $response = $response->getBody()->getContents();

        $decodedResponse = json_decode($response, true);
        if (is_array($decodedResponse) === false) {
            throw new \Exception('Unable to decode API auth token endpoint');
        }

        $this->authToken = $decodedResponse['access_token'];
        return true;
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
     * @return Product[]|null
     */
    public function getProducts(): ?array
    {
        try {
            $catalogs = $this->getCatalogs();
            $products = $this->getProductsByCatalogCollection($catalogs);
            return $products;
        } catch (RequestException $e) {
            $this->setRequestExceptionError($e);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function getPackagingOptions()
    {
        try {
            $url = $this->getApiUrl() . '/programs/programs/' . $this->getProgramId() . '/packaging';

            $response = $this->getHttpClient()->get($url, [
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAuthToken()
                ]
            ]);

            $response = $response->getBody()->getContents();
            $decodedResponse = json_decode($response, true);

            if (is_array($decodedResponse) === false) {
                throw new \Exception('Unable to decode API packaging endpoint');
            }

            $packagingCollection = [];
            foreach ($decodedResponse as $option) {
                $packagingCollection[] = new PackagingOption($option);
            }

            return $packagingCollection;
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    /**
     * @param array $body
     * @return bool|null
     */
    public function createOrder(array $body)
    {
        try {
            $url = $this->getTokenUrl() . '/orders';

            $response = $this->getHttpClient()->post($url, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                    'ProgramId' => $this->getProgramId(),
                ],
                'body' => json_encode($body)
            ]);

            if ($response->getStatusCode() === 202) {
                return true;
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    /**
     * @param array $body
     * @return bool|null
     */
    public function createImmediateOrder(array $body)
    {
        try {
            $url = $this->getTokenUrl() . '/orders/Immediate';

            $response = $this->getHttpClient()->post($url, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                    'ProgramId' => $this->getProgramId(),
                ],
                'body' => json_encode($body)
            ]);

            if ($response->getStatusCode() === 201) {
                return true;
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    /**
     * @param array $catalogs
     * @return array
     * @throws \Exception
     */
    private function getProductsByCatalogCollection(array $catalogs = [])
    {
        if (empty($this->productCollection)) {
            foreach ($catalogs as $catalog) {
                    $this->hydrateCatalogProducts($catalog->getId());
                    $this->getCatalogAssets($catalog->getId());
            }
        }

        return $this->productCollection;
    }

    /**
     * @param int $catalogId
     * @throws \Exception
     */
    private function hydrateCatalogProducts(int $catalogId)
    {
        $url = $this->getApiUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs/' . $catalogId;
        $response = $this->getHttpClient()->get($url, [
            'debug' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken()
            ]
        ]);
        $response = $response->getBody()->getContents();

        $decodedResponse = json_decode($response, true);
        if (is_array($decodedResponse) === false) {
            throw new \Exception('Unable to decode API catalog product endpoint');
        }

        foreach ($decodedResponse['products'] as $product) {
            $sku = $product['productSku'];
            $this->productCollection[$sku] = new Product($product);
        }
    }


    /**
     * @param int $catalogId
     * @return array
     * @throws \Exception
     */
    private function getCatalogAssets(int $catalogId)
    {
        $url = $this->getApiUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs/' . $catalogId . '/assets';
        $response = $this->getHttpClient()->get($url, [
            'debug' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken()
            ]
        ]);
        $response = $response->getBody()->getContents();

        $decodedResponse = json_decode($response, true);
        if (is_array($decodedResponse) === false) {
            throw new \Exception('Unable to decode API catalog asset endpoint');
        }

        $productAssets = null;
        foreach ($decodedResponse as $assetLocalization) {
            if ($assetLocalization['languageCulture'] === 'en-US') {
                $productAssets = $assetLocalization['products'];
            }
        }

        $this->hydrateCatalogAssets($productAssets);

    }

    /**
     * @param $assets
     * @throws \Exception
     */
    private function hydrateCatalogAssets($assets)
    {
        foreach ($assets as $product) {
            $sku = $product['productSku'];
            /** @var Product $oProduct */
            $oProduct = $this->productCollection[$sku];
            foreach ($product['assets'] as $asset) {
                switch ($asset['type']) {
                    case 'cardholderagreement':
                        $oProduct->setTermAttachment($asset['href']);
                        break;
                    case 'legaldisclaimer':
                        $oProduct->setDisclosure($asset['text']);
                        break;
                    case 'termsconditions':
                        $oProduct->setTerms($asset['text']);
                        break;
                    case 'marketingdescription':
                        //Overrides the description that is set from the product catalog
                        $oProduct->setDescription($asset['text']);
                        break;
                    case 'cardimage':
                        $oProduct->setImage($asset['href']);
                        break;
                    case 'redemptioninstructions':
                        continue;
                    default:
                        throw new \Exception('Unknown asset type iterated: ' . $asset['type']);
                }
            }
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getCatalogs()
    {
        $url = $this->getApiUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs';
        $response = $this->getHttpClient()->get($url, [
            'debug' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken()
            ]
        ]);
        $response = $response->getBody()->getContents();
        $decodedResponse = json_decode($response, true);
        if (is_array($decodedResponse) === false) {
            throw new \Exception('Unable to decode API catalog endpoint');
        }

        $catalogCollection = [];
        foreach ($decodedResponse as $catalog) {
            $catalogCollection[] = new Catalog($catalog);
        }

        return $catalogCollection;
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
        $this->errors[] = is_string($errors) === true ? $errors : $errors[key($errors)];
    }
}

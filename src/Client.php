<?php

namespace AllDigitalRewards\Vendor\InComm;

use AllDigitalRewards\Vendor\InComm\Entities\AuthTokenRequest;
use AllDigitalRewards\Vendor\InComm\Entities\OrderCard;
use AllDigitalRewards\Vendor\InComm\Entities\OrderResponse;
use AllDigitalRewards\Vendor\InComm\Entities\OrderStatus;
use AllDigitalRewards\Vendor\InComm\Entities\PackagingOption;
use AllDigitalRewards\Vendor\InComm\Entities\Product;
use AllDigitalRewards\Vendor\InComm\Entities\Catalog;
use AllDigitalRewards\Vendor\InComm\Entities\Program;
use GuzzleHttp\Exception\RequestException;

class Client
{
    /**
     * @var string
     */
    private $apiUrl = 'https://api.giftango.com';

    private $appUrl = 'https://app.giftango.com';

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
    public function getAppUrl(): string
    {
        return $this->appUrl;
    }

    /**
     * @param string $appUrl
     */
    public function setAppUrl(string $appUrl): void
    {
        $this->appUrl = $appUrl;
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
        $url = $this->getApiUrl() . '/auth/token';
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

    public function getPrograms()
    {
        try {
            $url = $this->getAppUrl() . '/programs/programs';

            $response = $this->getHttpClient()->get($url, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                ],
            ]);
            if ($response->getStatusCode() === 200) {
                $programs = json_decode($response->getBody(), true);
                $collection = [];
                foreach ($programs as $program) {
                    $collection[] = new Program($program);
                }
                return $collection;
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
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
            $url = $this->getAppUrl() . '/programs/programs/' . $this->getProgramId() . '/packaging';

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
     * @return null
     */
    public function createOrder(array $body)
    {
        try {
            $url = $this->getApiUrl() . '/orders';

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
                return $response->getHeader('Location')[0];
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    public function getOrder(string $uri)
    {
        try {
            $response = $this->getHttpClient()->get($uri, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                    'ProgramId' => $this->getProgramId(),
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

    public function getOrderCards(string $uri)
    {
        try {
            $uri = $uri . '/cards';
            $response = $this->getHttpClient()->get($uri, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                    'ProgramId' => $this->getProgramId(),
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $orderCards = json_decode($response->getBody(), true);
                $collection = [];
                foreach ($orderCards as $orderCard) {
                    $collection[] = new OrderCard($orderCard);
                }
                return $collection;
            }
        } catch (RequestException $exception) {
            $this->setRequestExceptionError($exception);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        return null;
    }

    public function getAllOrderFulfillmentStatuses()
    {
        try {
            $url = $this->getApiUrl() . '/fulfillment';

            $response = $this->getHttpClient()->get($url, [
                'debug' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getAuthToken(),
                    'ProgramId' => $this->getProgramId(),
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $statuses = json_decode($response->getBody(), true);
                $collection = [];
                foreach ($statuses as $status) {
                    $collection[] = new OrderStatus($status);
                }
                return $collection;
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
            $url = $this->getApiUrl() . '/orders/Immediate';

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
        $url = $this->getAppUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs/' . $catalogId;
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
        $url = $this->getAppUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs/' . $catalogId . '/assets';
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
        $url = $this->getAppUrl() . '/programs/programs/' . $this->getProgramId() . '/catalogs';
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
        if (is_string($errors) === true || is_null($errors) === true) {
            $this->errors[] = $errors;
            return;
        }

        foreach ($errors as $error) {
            if (is_array($error) === true) {
                foreach ($error as $embedded) {
                    $this->errors[] = $embedded;
                }
                continue;
            }
            $this->errors[] = $error;
        }
    }
}

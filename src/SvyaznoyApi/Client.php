<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Request\Cities as CitiesRequest;
use SvyaznoyApi\Request\OutpostPoints as OutpostPointsRequest;
use SvyaznoyApi\Request\MetroStations as MetroStationsRequest;
use SvyaznoyApi\Request\MetroLines as MetroLinesRequest;
use SvyaznoyApi\Request\Delivery as DeliveryRequest;
use SvyaznoyApi\Request\Order as OrderRequest;

class Client
{

    const URI_PROD_AUTH = 'https://auth.svyaznoy.ru';
    const URI_PROD_API = 'https://api.svyaznoy.ru/v1';
    const URI_PROD_DELIVERY = 'https://api.svyaznoy.ru/v1';

    const URI_DEMO_AUTH = 'http://auth.sandbox.dev.svyaznoy.ru';
    const URI_DEMO_API = 'http://api.sandbox.dev.svyaznoy.ru/v1';
    const URI_DEMO_DELIVERY = 'http://demoad.8000.dev.svyaznoy.ru/v1';

    /** @var ClientConfiguration $configuration */
    private $configuration;
    private $tokenStorage;
    private $uriAuth;
    private $uriDelivery;
    private $uriApi;

    public function __construct($clientConfiguration)
    {
        $this->configuration = $clientConfiguration;
        switch ($this->configuration->getMode()) {
            case ClientConfiguration::MODE_TEST:
                $this->uriAuth = self::URI_DEMO_AUTH;
                $this->uriApi = self::URI_DEMO_API;
                $this->uriDelivery = self::URI_DEMO_DELIVERY;
                break;
            case ClientConfiguration::MODE_PROD:
                $this->uriAuth = self::URI_PROD_AUTH;
                $this->uriApi = self::URI_PROD_API;
                $this->uriDelivery = self::URI_PROD_DELIVERY;
                break;
        }
    }

    /**
     * @return ClientConfiguration
     */
    public function getConfiguration(): ClientConfiguration
    {
        return $this->configuration;
    }

    public function setTokenStorage(ITokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return null|ITokenStorage
     */
    public function getTokenStorage()
    {
        return $this->tokenStorage;
    }

    /**
     * @return string
     */
    public function getUriApi()
    {
        return $this->uriApi;
    }

    /**
     * @return string
     */
    public function getUriAuth()
    {
        return $this->uriAuth;
    }

    /**
     * @return string
     */
    public function getUriDelivery()
    {
        return $this->uriDelivery;
    }

    /**
     * Метод возвращает список городов
     * @return CitiesRequest
     */
    public function cities()
    {
        return new CitiesRequest($this->uriApi, new Authenticator($this));
    }

    public function outpostPoints()
    {
        return new OutpostPointsRequest($this->uriApi, new Authenticator($this));
    }

    public function metroStations()
    {
        return new MetroStationsRequest($this->uriApi, new Authenticator($this));
    }

    public function metroLines()
    {
        return new MetroLinesRequest($this->uriApi, new Authenticator($this));
    }

    public function delivery()
    {
        return new DeliveryRequest($this->uriDelivery, new Authenticator($this));
    }

    public function order()
    {
        return new OrderRequest($this->uriApi, new Authenticator($this));
    }

}
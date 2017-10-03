<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Request\Cities as CitiesRequest;
use SvyaznoyApi\Request\City as CityRequest;
use SvyaznoyApi\Request\OutpostPoints as OutpostPointsRequest;
use SvyaznoyApi\Request\MetroStations as MetroStationsRequest;
use SvyaznoyApi\Request\MetroStation as MetroStationRequest;
use SvyaznoyApi\Request\MetroLines as MetroLinesRequest;
use SvyaznoyApi\Request\MetroLine as MetroLineRequest;
use SvyaznoyApi\Request\MetroLineStations as MetroLineStationsRequest;
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

    private $username;
    private $password;
    private $tokenStorage;
    private $uriAuth;
    private $uriDelivery;
    private $uriApi;

    public static function getTest(ClientAuthentication $clientAuthentication)
    {
        $client = new self();
        $client->setUsername($clientAuthentication->getUsername());
        $client->setPassword($clientAuthentication->getPassword());
        $client->setUriAuth(self::URI_DEMO_AUTH);
        $client->setUriApi(self::URI_DEMO_API);
        $client->setUriDelivery(self::URI_DEMO_DELIVERY);
        return $client;
    }

    public static function getProd(ClientAuthentication $clientAuthentication)
    {
        $client = new self();
        $client->setUsername($clientAuthentication->getUsername());
        $client->setPassword($clientAuthentication->getPassword());
        $client->setUriAuth(self::URI_PROD_AUTH);
        $client->setUriApi(self::URI_PROD_API);
        $client->setUriDelivery(self::URI_PROD_DELIVERY);
        return $client;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
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
     * @param string $uriApi
     */
    public function setUriApi($uriApi)
    {
        $this->uriApi = $uriApi;
    }

    /**
     * @param string $uriAuth
     */
    public function setUriAuth($uriAuth)
    {
        $this->uriAuth = $uriAuth;
    }

    /**
     * @param string $uriDelivery
     */
    public function setUriDelivery($uriDelivery)
    {
        $this->uriDelivery = $uriDelivery;
    }

    /**
     * Метод возвращает список городов
     * @return CitiesRequest
     */
    public function cities()
    {
        return new CitiesRequest($this);
    }

    /**
     * Метод возвращает информацию о городе
     * @return CityRequest
     */
    public function city()
    {
        return new CityRequest($this);
    }

    public function outpostPoints()
    {
        return new OutpostPointsRequest($this);
    }

    public function metroStations()
    {
        return new MetroStationsRequest($this);
    }

    public function metroStation()
    {
        return new MetroStationRequest($this);
    }

    public function metroLines()
    {
        return new MetroLinesRequest($this);
    }

    public function metroLine()
    {
        return new MetroLineRequest($this);
    }

    public function metroLineStations()
    {
        return new MetroLineStationsRequest($this);
    }

    public function delivery()
    {
        return new DeliveryRequest($this);
    }

    public function order()
    {
        return new OrderRequest($this);
    }

}
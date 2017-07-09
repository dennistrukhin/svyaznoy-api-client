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

    private $username;
    private $password;
    private $tokenStorage;
    private $uriAuth = 'https://auth.svyaznoy.ru';
    private $uriDelivery = 'http://py.svyaznoy.ru';
    private $uriApi = 'https://api.svyaznoy.ru/v1';

    public function __construct($username, $password)
    {
        $this->username = $username;
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
<?php
namespace SvyaznoyApi\Entity;

class OutpostPoint
{

    private $id = '';
    private $name = '';
    private $images = [];
    private $cityId = 0;
    private $active = false;
    private $address = '';
    private $stationIds = [];
    private $yandxAddress = '';
    private $workTime = [];
    private $workTimeCustom;
    private $longitude = 0;
    private $latitude = 0;
    private $email = '';
    private $directions = '';
    private $shopType = 0;
    private $credit = false;
    private $services = [];
    private $twentyFourHour = false;

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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     */
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return array
     */
    public function getStationIds(): array
    {
        return $this->stationIds;
    }

    /**
     * @param array $stationIds
     */
    public function setStationIds(array $stationIds)
    {
        $this->stationIds = $stationIds;
    }

    /**
     * @return string
     */
    public function getYandxAddress(): string
    {
        return $this->yandxAddress;
    }

    /**
     * @param string $yandxAddress
     */
    public function setYandxAddress(string $yandxAddress)
    {
        $this->yandxAddress = $yandxAddress;
    }

    /**
     * @return array
     */
    public function getWorkTime(): array
    {
        return $this->workTime;
    }

    /**
     * @param array $workTime
     */
    public function setWorkTime(array $workTime)
    {
        $this->workTime = $workTime;
    }

    /**
     * @return mixed
     */
    public function getWorkTimeCustom()
    {
        return $this->workTimeCustom;
    }

    /**
     * @param mixed $workTimeCustom
     */
    public function setWorkTimeCustom($workTimeCustom)
    {
        $this->workTimeCustom = $workTimeCustom;
    }

    /**
     * @return int
     */
    public function getLongitude(): int
    {
        return $this->longitude;
    }

    /**
     * @param int $longitude
     */
    public function setLongitude(int $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getLatitude(): int
    {
        return $this->latitude;
    }

    /**
     * @param int $latitude
     */
    public function setLatitude(int $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDirections(): string
    {
        return $this->directions;
    }

    /**
     * @param string $directions
     */
    public function setDirections(string $directions)
    {
        $this->directions = $directions;
    }

    /**
     * @return int
     */
    public function getShopType(): int
    {
        return $this->shopType;
    }

    /**
     * @param int $shopType
     */
    public function setShopType(int $shopType)
    {
        $this->shopType = $shopType;
    }

    /**
     * @return bool
     */
    public function hasCredit(): bool
    {
        return $this->credit;
    }

    /**
     * @param bool $credit
     */
    public function setCredit(bool $credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array $services
     */
    public function setServices(array $services)
    {
        $this->services = $services;
    }

    /**
     * @return bool
     */
    public function isTwentyFourHour(): bool
    {
        return $this->twentyFourHour;
    }

    /**
     * @param bool $twentyFourHour
     */
    public function setTwentyFourHour(bool $twentyFourHour)
    {
        $this->twentyFourHour = $twentyFourHour;
    }



}
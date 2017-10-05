<?php
namespace SvyaznoyApi\Entity;

use SvyaznoyApi\Library\OutpostWorkTime;

class OutpostPoint
{

    private $id = '';
    private $name = '';
    private $images = [];
    private $cityId = 0;
    private $active = false;
    private $address = '';
    private $stationIds = [];
    private $yandexAddress = '';
    /** @var OutpostWorkTime $workTime */
    private $workTime;
    private $workTimeCustom;
    private $longitude = 0.;
    private $latitude = 0.;
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
    public function setId(string $id): void
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
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
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
    public function setCityId(int $cityId): void
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
    public function setActive(bool $active): void
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
    public function setAddress(string $address): void
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
    public function setStationIds(array $stationIds): void
    {
        $this->stationIds = $stationIds;
    }

    /**
     * @return string
     */
    public function getYandexAddress(): string
    {
        return $this->yandexAddress;
    }

    /**
     * @param string $yandexAddress
     */
    public function setYandexAddress(string $yandexAddress): void
    {
        $this->yandexAddress = $yandexAddress;
    }

    /**
     * @return OutpostWorkTime
     */
    public function getWorkTime(): OutpostWorkTime
    {
        return $this->workTime;
    }

    /**
     * @param OutpostWorkTime $workTime
     */
    public function setWorkTime(OutpostWorkTime $workTime): void
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
    public function setWorkTimeCustom($workTimeCustom): void
    {
        $this->workTimeCustom = $workTimeCustom;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
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
    public function setEmail(string $email): void
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
    public function setDirections(string $directions): void
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
    public function setShopType(int $shopType): void
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
    public function setCredit(bool $credit): void
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
    public function setServices(array $services): void
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
    public function setTwentyFourHour(bool $twentyFourHour): void
    {
        $this->twentyFourHour = $twentyFourHour;
    }



}
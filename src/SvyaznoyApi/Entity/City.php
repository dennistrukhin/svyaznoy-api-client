<?php
namespace SvyaznoyApi\Entity;

use SvyaznoyApi\Library\Declension;

class City
{

    private $id = 0;
    private $name = '';
    private $alias = '';
    /** @var Declension $declension */
    private $declension;
    private $cityTypeId = 0;
    private $deliveryTypeIds = [];
    private $paymentTypeIds = [];
    private $rulePriorityId = 0;
    private $regionId = 0;
    private $zoneId = 0;
    private $territoryId = 0;
    private $kladrCode = '';
    private $timeOffset = '';
    private $metro = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return Declension
     */
    public function getDeclension(): Declension
    {
        return $this->declension;
    }

    /**
     * @param Declension $declension
     */
    public function setDeclension(Declension $declension): void
    {
        $this->declension = $declension;
    }

    /**
     * @return int
     */
    public function getCityTypeId(): int
    {
        return $this->cityTypeId;
    }

    /**
     * @param int $cityTypeId
     */
    public function setCityTypeId(int $cityTypeId): void
    {
        $this->cityTypeId = $cityTypeId;
    }

    /**
     * @return array
     */
    public function getDeliveryTypeIds(): array
    {
        return $this->deliveryTypeIds;
    }

    /**
     * @param array $deliveryTypeIds
     */
    public function setDeliveryTypeIds(array $deliveryTypeIds): void
    {
        $this->deliveryTypeIds = $deliveryTypeIds;
    }

    /**
     * @return array
     */
    public function getPaymentTypeIds(): array
    {
        return $this->paymentTypeIds;
    }

    /**
     * @param array $paymentTypeIds
     */
    public function setPaymentTypeIds(array $paymentTypeIds): void
    {
        $this->paymentTypeIds = $paymentTypeIds;
    }

    /**
     * @return int
     */
    public function getRulePriorityId(): int
    {
        return $this->rulePriorityId;
    }

    /**
     * @param int $rulePriorityId
     */
    public function setRulePriorityId(int $rulePriorityId): void
    {
        $this->rulePriorityId = $rulePriorityId;
    }

    /**
     * @return int
     */
    public function getRegionId(): int
    {
        return $this->regionId;
    }

    /**
     * @param int $regionId
     */
    public function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    /**
     * @return int
     */
    public function getZoneId(): int
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     */
    public function setZoneId(int $zoneId): void
    {
        $this->zoneId = $zoneId;
    }

    /**
     * @return int
     */
    public function getTerritoryId(): int
    {
        return $this->territoryId;
    }

    /**
     * @param int $territoryId
     */
    public function setTerritoryId(int $territoryId): void
    {
        $this->territoryId = $territoryId;
    }

    /**
     * @return string
     */
    public function getKladrCode(): string
    {
        return $this->kladrCode;
    }

    /**
     * @param string $kladrCode
     */
    public function setKladrCode(string $kladrCode): void
    {
        $this->kladrCode = $kladrCode;
    }

    /**
     * @return string
     */
    public function getTimeOffset(): string
    {
        return $this->timeOffset;
    }

    /**
     * @param string $timeOffset
     */
    public function setTimeOffset(string $timeOffset): void
    {
        $this->timeOffset = $timeOffset;
    }

    /**
     * @return bool
     */
    public function hasMetro(): bool
    {
        return $this->metro;
    }

    /**
     * @param bool $metro
     */
    public function setMetro(bool $metro): void
    {
        $this->metro = $metro;
    }

}
<?php
namespace SvyaznoyApi\Entity;

class MetroStation
{

    private $id = 0;
    private $name = '';
    private $lineId = 0;
    private $cityId = 0;

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
    public function setId(int $id)
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
     * @return int
     */
    public function getLineId(): int
    {
        return $this->lineId;
    }

    /**
     * @param int $lineId
     */
    public function setLineId(int $lineId)
    {
        $this->lineId = $lineId;
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

}
<?php
namespace SvyaznoyApi\Request;

class DeliveryFilter
{

    private $cityId = 0;

    /**
     * @param int $cityId
     */
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

}
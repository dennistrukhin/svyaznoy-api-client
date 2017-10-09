<?php
namespace SvyaznoyApi\Request;

class DeliveryFilter
{

    private $cityId = 0;
    private $outpostPointIds = [];
    /** @var \DateTime $orderDate */
    private $orderDate;

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

    /**
     * @return array
     */
    public function getOutpostPointIds(): array
    {
        return $this->outpostPointIds;
    }

    /**
     * @param array $outpostPointIds
     */
    public function setOutpostPointIds(array $outpostPointIds)
    {
        $this->outpostPointIds = $outpostPointIds;
    }

    /**
     * @return \DateTime|null
     */
    public function getOrderDate(): ?\DateTime
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime|null $orderDate
     */
    public function setOrderDate(?\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;
    }



}
<?php
namespace SvyaznoyApi\Entity;

use SvyaznoyApi\Library\BasketSumRange;
use SvyaznoyApi\Library\TimeInterval;

class Delivery
{

    private $paymentTypeId = 0;
    private $reserveDays = 0;
    /** @var TimeInterval $interval */
    private $interval;
    private $orderTypeId = 0;
    private $deliveryCost = 0;
    private $deliveryTypeId = 0;
    private $deliveryPurpose = '';
    /** @var BasketSumRange $basketSumRange */
    private $basketSumRange;
    private $outpostPointId = '';
    /** @var \DateTime $datetime */
    private $datetime;

    /**
     * @return int
     */
    public function getPaymentTypeId(): int
    {
        return $this->paymentTypeId;
    }

    /**
     * @param int $paymentTypeId
     */
    public function setPaymentTypeId(int $paymentTypeId)
    {
        $this->paymentTypeId = $paymentTypeId;
    }

    /**
     * @return int
     */
    public function getReserveDays(): int
    {
        return $this->reserveDays;
    }

    /**
     * @param int $reserveDays
     */
    public function setReserveDays(int $reserveDays)
    {
        $this->reserveDays = $reserveDays;
    }

    /**
     * @return TimeInterval
     */
    public function getInterval(): TimeInterval
    {
        return $this->interval;
    }

    /**
     * @param TimeInterval $interval
     */
    public function setInterval(TimeInterval $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return int
     */
    public function getOrderTypeId(): int
    {
        return $this->orderTypeId;
    }

    /**
     * @param int $orderTypeId
     */
    public function setOrderTypeId(int $orderTypeId)
    {
        $this->orderTypeId = $orderTypeId;
    }

    /**
     * @return int
     */
    public function getDeliveryCost(): int
    {
        return $this->deliveryCost;
    }

    /**
     * @param int $deliveryCost
     */
    public function setDeliveryCost(int $deliveryCost)
    {
        $this->deliveryCost = $deliveryCost;
    }

    /**
     * @return int
     */
    public function getDeliveryTypeId(): int
    {
        return $this->deliveryTypeId;
    }

    /**
     * @param int $deliveryTypeId
     */
    public function setDeliveryTypeId(int $deliveryTypeId)
    {
        $this->deliveryTypeId = $deliveryTypeId;
    }

    /**
     * @return string
     */
    public function getDeliveryPurpose(): string
    {
        return $this->deliveryPurpose;
    }

    /**
     * @param string $deliveryPurpose
     */
    public function setDeliveryPurpose(string $deliveryPurpose)
    {
        $this->deliveryPurpose = $deliveryPurpose;
    }

    /**
     * @return BasketSumRange
     */
    public function getBasketSumRange(): BasketSumRange
    {
        return $this->basketSumRange;
    }

    /**
     * @param BasketSumRange $basketSumRange
     */
    public function setBasketSumRange(BasketSumRange $basketSumRange)
    {
        $this->basketSumRange = $basketSumRange;
    }

    /**
     * @return string
     */
    public function getOutpostPointId(): string
    {
        return $this->outpostPointId;
    }

    /**
     * @param string $outpostPointId
     */
    public function setOutpostPointId(string $outpostPointId)
    {
        $this->outpostPointId = $outpostPointId;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }



}
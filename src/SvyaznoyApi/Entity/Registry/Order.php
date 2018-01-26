<?php
namespace SvyaznoyApi\Entity\Registry;

use SvyaznoyApi\Entity\Registry\Order\Owner;
use SvyaznoyApi\Entity\Registry\Order\Recipient;
use SvyaznoyApi\Exception\InvalidArgument;

class Order
{

    private $givenId = '';
    private $declaredValue = 0.0;
    /** @var Owner $owner */
    private $owner;
    private $deliveryCost = 0.0;
    private $deliveryDate = '';
    private $deliveryPoint = '';
    private $paymentSum = 0.0;
    private $paymentType = '';
    /** @var Recipient $recipient */
    private $recipient;
    /** @var Parcel[] $parcels */
    private $parcels = [];

    /**
     * @return string
     */
    public function getGivenId(): string
    {
        return $this->givenId;
    }

    /**
     * @return float
     */
    public function getDeclaredValue(): float
    {
        return $this->declaredValue;
    }

    /**
     * @return Owner
     */
    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    /**
     * @return float
     */
    public function getDeliveryCost(): float
    {
        return $this->deliveryCost;
    }

    /**
     * @return string
     */
    public function getDeliveryDate(): string
    {
        return $this->deliveryDate;
    }

    /**
     * @return string
     */
    public function getDeliveryPoint(): string
    {
        return $this->deliveryPoint;
    }

    /**
     * @return float
     */
    public function getPaymentSum(): float
    {
        return $this->paymentSum;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * @return Recipient
     */
    public function getRecipient(): ?Recipient
    {
        return $this->recipient;
    }

    /**
     * @return Parcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param Parcel $parcel
     * @throws InvalidArgument
     */
    public function addParcel(Parcel $parcel)
    {
        if (count($parcel->getInventory()) == 0) {
            throw new InvalidArgument('В посылке нет ни одного элемента (товара)');
        }
        $this->parcels[] = $parcel;
    }

    /**
     * @param float $declaredValue
     */
    public function setDeclaredValue(float $declaredValue): void
    {
        $this->declaredValue = $declaredValue;
    }

    /**
     * @param float $deliveryCost
     */
    public function setDeliveryCost(float $deliveryCost): void
    {
        $this->deliveryCost = $deliveryCost;
    }

    /**
     * @param string $deliveryDate
     * @throws InvalidArgument
     */
    public function setDeliveryDate(string $deliveryDate): void
    {
        if (!preg_match('#\d{4}-\d{2}-\d{2}#', $deliveryDate)) {
            throw new InvalidArgument('Неверный формат даты доствавки заказа');
        }
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @param string $deliveryPoint
     * @throws InvalidArgument
     */
    public function setDeliveryPoint(string $deliveryPoint): void
    {
        if (strlen($deliveryPoint) != 8) {
            throw new InvalidArgument('Неверный формат id торговой точки, ожидается 8 символов');
        }
        $this->deliveryPoint = $deliveryPoint;
    }

    /**
     * @param string $givenId
     */
    public function setGivenId(string $givenId): void
    {
        $this->givenId = $givenId;
    }

    /**
     * @param Owner $owner
     */
    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @param Parcel[] $parcels
     */
    public function setParcels(array $parcels): void
    {
        $this->parcels = $parcels;
    }

    /**
     * @param float $paymentSum
     */
    public function setPaymentSum(float $paymentSum): void
    {
        $this->paymentSum = $paymentSum;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType(string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient(Recipient $recipient): void
    {
        $this->recipient = $recipient;
    }

}
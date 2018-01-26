<?php
namespace SvyaznoyApi\Entity;

use SvyaznoyApi\Library\Cart;
use SvyaznoyApi\Library\CityPhone;
use SvyaznoyApi\Library\DeliveryDate;
use SvyaznoyApi\Library\MobilePhone;
use SvyaznoyApi\Library\TimeInterval;

class Order implements \JsonSerializable
{

    private $partnerOrderNumber = '';
    private $cityId = 0;
    private $deliveryTypeId = 0;
    private $paymentTypeId = 0;
    /** @var DeliveryDate $deliveryDate */
    private $deliveryDate;
    /** @var TimeInterval $deliveryInterval */
    private $deliveryInterval;
    private $contactName = '';
    /** @var MobilePhone $mobilePhone */
    private $mobilePhone;
    /** @var CityPhone $cityPhone */
    private $cityPhone;
    private $email = '';
    private $outpostPointId = '';
    /** @var \DateTime */
    private $calculationDateTime;
    private $companyName = '';
    private $companyInn = '';
    /** @var Cart $cart */
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    /**
     * @return string
     */
    public function getPartnerOrderNumber(): string
    {
        return $this->partnerOrderNumber;
    }

    /**
     * @param string $partnerOrderNumber
     */
    public function setPartnerOrderNumber(string $partnerOrderNumber)
    {
        $this->partnerOrderNumber = $partnerOrderNumber;
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
     * @return DeliveryDate
     */
    public function getDeliveryDate(): ?DeliveryDate
    {
        return $this->deliveryDate;
    }

    /**
     * @param DeliveryDate $deliveryDate
     */
    public function setDeliveryDate(DeliveryDate $deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @return TimeInterval
     */
    public function getDeliveryInterval(): ?TimeInterval
    {
        return $this->deliveryInterval;
    }

    /**
     * @param TimeInterval $deliveryInterval
     */
    public function setDeliveryInterval(TimeInterval $deliveryInterval)
    {
        $this->deliveryInterval = $deliveryInterval;
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    /**
     * @param string $contactName
     */
    public function setContactName(string $contactName)
    {
        $this->contactName = $contactName;
    }

    /**
     * @return MobilePhone
     */
    public function getMobilePhone(): ?MobilePhone
    {
        return $this->mobilePhone;
    }

    /**
     * @param MobilePhone $mobilePhone
     */
    public function setMobilePhone(MobilePhone $mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return CityPhone
     */
    public function getCityPhone(): ?CityPhone
    {
        return $this->cityPhone;
    }

    /**
     * @param CityPhone $cityPhone
     */
    public function setCityPhone(CityPhone $cityPhone)
    {
        $this->cityPhone = $cityPhone;
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
    public function getCalculationDateTime(): ?\DateTime
    {
        return $this->calculationDateTime;
    }

    /**
     * @param \DateTime $calculationDateTime
     */
    public function setCalculationDateTime(\DateTime $calculationDateTime)
    {
        $this->calculationDateTime = $calculationDateTime;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getCompanyInn(): string
    {
        return $this->companyInn;
    }

    /**
     * @param string $companyInn
     */
    public function setCompanyInn(string $companyInn)
    {
        $this->companyInn = $companyInn;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
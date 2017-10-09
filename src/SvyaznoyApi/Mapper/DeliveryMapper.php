<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\Delivery;
use SvyaznoyApi\Library\BasketSumRange;
use SvyaznoyApi\Library\TimeInterval;

class DeliveryMapper
{

    /**
     * @param array $data
     * @return Delivery
     */
    public function map(array $data)
    {
        $delivery = new Delivery();
        $delivery->setBasketSumRange(
            new BasketSumRange(
                (int)$data['basket_sum_range'][0],
                (int)$data['basket_sum_range'][1]
            )
        );
        $delivery->setDatetime(\DateTime::createFromFormat(DATE_ISO8601, $data['datetime']));
        $delivery->setDeliveryCost((int)$data['delivery_cost']);
        $delivery->setDeliveryPurpose((string)$data['delivery_purpose']);
        $delivery->setDeliveryTypeId((int)$data['delivery_type_id']);
        $delivery->setOutpostPointId(str_pad($data['finish_storage_id'], 8, '0', STR_PAD_LEFT));
        $delivery->setInterval(TimeInterval::makeFromString($data['interval']));
        $delivery->setOrderTypeId((int)$data['order_type_id']);
        $delivery->setPaymentTypeId((int)$data['payment_type_id']);
        $delivery->setReserveDays((int)$data['reserve_days']);
        return $delivery;
    }

}
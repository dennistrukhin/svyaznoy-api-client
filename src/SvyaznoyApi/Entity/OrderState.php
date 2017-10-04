<?php
namespace SvyaznoyApi\Entity;

class OrderState
{

    const STATE_NEW = 'new';
    const STATE_REGISTERED = 'registered';
    const STATE_SENT_TO_SHOP = 'sentToShop';
    const STATE_ARRIVED_TO_SHOP = 'arrivedToShop';
    const STATE_FINISHED = 'finished';
    const STATE_CANCELLED = 'cancelled';
    const STATE_RETURNED_TO_STORAGE = 'returnedToStorage';

    private static $typeStrings = [
        self::STATE_NEW => 'Заказ создан',
        self::STATE_REGISTERED => 'Заказ принят и поставлен в план на отправку в пункт выдачи',
        self::STATE_SENT_TO_SHOP => 'Заказ отправлен (находится в пути) в пункт выдачи',
        self::STATE_ARRIVED_TO_SHOP => 'Заказ поступил в пункт выдачи',
        self::STATE_FINISHED => 'Заказ выполнен, вручен клиенту',
        self::STATE_CANCELLED => 'Заказ отменен',
        self::STATE_RETURNED_TO_STORAGE => 'Заказ находится на складе возврата',
    ];

    public static function getName($type)
    {
        if (isset(self::$typeStrings[$type])) {
            return self::$typeStrings[$type];
        }
        return 'Неизвестное состояние заказа';
    }

}
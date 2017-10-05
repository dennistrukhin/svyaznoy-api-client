<?php
namespace SvyaznoyApi\Library;

class PaymentType
{

    const TYPE_CASH = 1;
    const TYPE_CARD = 2;
    const UNKNOWN_TYPE_STRING = 'Неизвестный тип оплаты';

    public static $typeStrings = [
        self::TYPE_CASH => 'Оплата наличными',
        self::TYPE_CARD => 'Оплата платежной картой при получении заказа',
    ];

    public static function getName($type)
    {
        if (isset(self::$typeStrings[$type])) {
            return self::$typeStrings[$type];
        }
        return self::UNKNOWN_TYPE_STRING;
    }

}
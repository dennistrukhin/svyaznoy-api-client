<?php
namespace SvyaznoyApi\Entity;

class PaymentType
{

    const TYPE_CASH = 1;
    const TYPE_CARD = 2;

    private static $typeStrings = [
        self::TYPE_CASH => 'Оплата наличными',
        self::TYPE_CARD => 'Оплата платежной картой при получении заказа',
    ];

    public static function getName($type)
    {
        if (isset(self::$typeStrings[$type])) {
            return self::$typeStrings[$type];
        }
        return 'Неизвестный тип оплаты';
    }

}
<?php
namespace SvyaznoyApi\Entity;

class DeliveryType
{

    const TYPE_OUTPOST = 9;

    private static $typeStrings = [
        self::TYPE_OUTPOST => 'Самовывоз: Продажа через торговую точку',
    ];

    public static function getName($type)
    {
        if (isset(self::$typeStrings[$type])) {
            return self::$typeStrings[$type];
        }
        return 'Неизвестный тип доставки';
    }

}
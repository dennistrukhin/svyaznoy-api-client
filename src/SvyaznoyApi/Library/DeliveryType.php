<?php
namespace SvyaznoyApi\Library;

class DeliveryType
{

    const TYPE_OUTPOST = 9;

    const UNKNOWN_TYPE_STRING = 'Неизвестный тип доставки';

    public static $typeStrings = [
        self::TYPE_OUTPOST => 'Самовывоз: Продажа через торговую точку',
    ];

    public static function getName($type)
    {
        if (isset(self::$typeStrings[$type])) {
            return self::$typeStrings[$type];
        }
        return self::UNKNOWN_TYPE_STRING;
    }

}
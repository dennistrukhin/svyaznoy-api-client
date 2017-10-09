<?php
namespace SvyaznoyApi\Library;

use SvyaznoyApi\Exception\InvalidArgument;

class MobilePhone extends APhone
{

    public function __construct(string $phoneNumber)
    {
        if (!preg_match('#9\d{9}#', $phoneNumber)) {
            throw new InvalidArgument('Номер мобильного телефона должен содержить 10 цифр и начинаться с 9');
        }
        $this->number = $phoneNumber;
    }

}
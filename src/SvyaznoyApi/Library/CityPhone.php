<?php
namespace SvyaznoyApi\Library;

class CityPhone extends APhone
{

    public function __construct(string $phoneNumber)
    {
        $this->number = $phoneNumber;
    }

}
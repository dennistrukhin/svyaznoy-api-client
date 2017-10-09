<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Exception\InvalidArgument;
use SvyaznoyApi\Library\CityPhone;
use SvyaznoyApi\Library\MobilePhone;

class CityPhoneTest extends TestCase
{

    public function testConstructorWithValidNumber()
    {
        $phone = new CityPhone('5431234567');
        $this->assertTrue($phone->getNumber() === '5431234567');
    }

}
<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Exception\InvalidArgument;
use SvyaznoyApi\Library\MobilePhone;

class MobilePhoneTest extends TestCase
{

    public function testConstructorWithValidNumber()
    {
        $phone = new MobilePhone('9121234567');
        $this->assertTrue($phone->getNumber() === '9121234567');
    }

    public function testConstructorWithInvalidNumber()
    {
        $this->expectException(InvalidArgument::class);
        new MobilePhone('6121234567');
    }

    public function testFormatting()
    {
        $phone = new MobilePhone('9121234567');
        $str = $phone->format('+7 (###) ###-##-##');
        $this->assertTrue(
            $str === '+7 (912) 123-45-67',
            'expected +7 (912) 123-45-67 and got ' . $str
        );
    }

}
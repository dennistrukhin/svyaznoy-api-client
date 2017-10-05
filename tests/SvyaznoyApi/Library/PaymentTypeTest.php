<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\PaymentType;

class PaymentTypeTest extends TestCase
{

    public function testGetString()
    {
        $this->assertTrue(PaymentType::getName(PaymentType::TYPE_CARD) == PaymentType::$typeStrings[PaymentType::TYPE_CARD]);
        $this->assertTrue(PaymentType::getName('NonExistentType') === PaymentType::UNKNOWN_TYPE_STRING);
    }

}
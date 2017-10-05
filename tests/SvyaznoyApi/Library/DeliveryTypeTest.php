<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\DeliveryType;

class DeliveryTypeTest extends TestCase
{

    public function testGetString()
    {
        $this->assertTrue(DeliveryType::getName(DeliveryType::TYPE_OUTPOST) == DeliveryType::$typeStrings[DeliveryType::TYPE_OUTPOST]);
        $this->assertTrue(DeliveryType::getName('NonExistentType') === DeliveryType::UNKNOWN_TYPE_STRING);
    }

}
<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\DeliveryDate;

class DeliveryDateTest extends TestCase
{

    public function testConstructor()
    {
        $date = new DeliveryDate(1, 2, 3);
        $this->assertTrue($date->getYear() === 1);
        $this->assertTrue($date->getMonth() === 2);
        $this->assertTrue($date->getDay() === 3);
    }

}
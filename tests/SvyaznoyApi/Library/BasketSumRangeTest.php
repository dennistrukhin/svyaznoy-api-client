<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\BasketSumRange;

class BasketSumRangeTest extends TestCase
{

    public function testConstructor()
    {
        $basketSumRange = new BasketSumRange(10, 20);
        $this->assertTrue($basketSumRange->getMin() === 10);
        $this->assertTrue($basketSumRange->getMax() === 20);
    }

}
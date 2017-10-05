<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\OrderState;

class OrderStateTest extends TestCase
{

    public function testGetString()
    {
        $this->assertTrue(OrderState::getName(OrderState::STATE_ARRIVED_TO_SHOP) == OrderState::$typeStrings[OrderState::STATE_ARRIVED_TO_SHOP]);
        $this->assertTrue(OrderState::getName('NonExistentType') === OrderState::UNKNOWN_STATE_STRING);
    }

}
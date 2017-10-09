<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\CartItem;

class CartItemTest extends TestCase
{

    public function testConstructorWithParams()
    {
        $cartItem = new CartItem('123', 1000, 2);
        $this->assertTrue($cartItem->getProductId() === '123');
        $this->assertTrue($cartItem->getPrice() === 1000);
        $this->assertTrue($cartItem->getQuantity() === 2);
    }

    public function testConstructorWithDefaultProductId()
    {
        $cartItem = new CartItem(null, 1000, 2);
        $this->assertTrue($cartItem->getProductId() === CartItem::DEFAULT_PRODUCT_ID);
    }

}
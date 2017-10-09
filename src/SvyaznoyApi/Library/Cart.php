<?php
namespace SvyaznoyApi\Library;

class Cart
{

    /** @var CartItem[] */
    private $items = [];

    /**
     * @param CartItem $cartItem
     */
    public function addItem(CartItem $cartItem)
    {
        $this->items[] = $cartItem;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}
<?php
namespace SvyaznoyApi\Library;

class Cart implements \JsonSerializable
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
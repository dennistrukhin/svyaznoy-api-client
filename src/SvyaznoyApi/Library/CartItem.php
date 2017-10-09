<?php
namespace SvyaznoyApi\Library;

class CartItem
{

    const DEFAULT_PRODUCT_ID = '2796047';

    private $productId = '';
    private $price = 0;
    private $quantity = 0;

    public function __construct(?string $productId, int $price, int $quantity)
    {
        $this->productId = $productId ?? self::DEFAULT_PRODUCT_ID;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
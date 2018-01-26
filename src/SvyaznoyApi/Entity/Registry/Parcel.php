<?php
namespace SvyaznoyApi\Entity\Registry;

class Parcel
{

    private $inventories = [];
    private $givenId;
    private $declaredValue;

    public function __construct(string $givenId, float $declaredValue, array $inventory = [])
    {
        $this->givenId = $givenId;
        $this->declaredValue = $declaredValue;
        $this->inventories = $inventory;
    }

    public function addInventory(Inventory $inventory)
    {
        $this->inventories[] = $inventory;
    }

    /**
     * @return float
     */
    public function getDeclaredValue(): float
    {
        return $this->declaredValue;
    }

    /**
     * @return string
     */
    public function getGivenId(): string
    {
        return $this->givenId;
    }

    /**
     * @return Inventory[]
     */
    public function getInventory(): array
    {
        return $this->inventories;
    }

}
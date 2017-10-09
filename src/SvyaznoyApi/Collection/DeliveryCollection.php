<?php
namespace SvyaznoyApi\Collection;

use SvyaznoyApi\Entity\Delivery;

class DeliveryCollection extends AbstractCollection
{

    public function push(Delivery $delivery): void
    {
        $this->pushElement($delivery);
    }

    /**
     * @return Delivery[]
     */
    public function get(): array
    {
        return $this->elements;
    }

}
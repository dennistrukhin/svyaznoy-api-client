<?php
namespace SvyaznoyApi\Collection;

use SvyaznoyApi\Entity\City;

class CityCollection extends AbstractCollection
{

    public function push(City $outpostPoint): void
    {
        $this->pushElement($outpostPoint);
    }

    /**
     * @return City[]
     */
    public function get(): array
    {
        return $this->elements;
    }

}
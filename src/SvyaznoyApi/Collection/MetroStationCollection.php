<?php
namespace SvyaznoyApi\Collection;

use SvyaznoyApi\Entity\MetroStation;

class MetroStationCollection extends AbstractCollection
{

    public function push(MetroStation $outpostPoint): void
    {
        $this->pushElement($outpostPoint);
    }

    /**
     * @return MetroStation[]
     */
    public function get(): array
    {
        return $this->elements;
    }

}
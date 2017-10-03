<?php
namespace SvyaznoyApi\Collection;

use SvyaznoyApi\Entity\OutpostPoint;

class OutpostPointCollection extends AbstractCollection
{

    public function push(OutpostPoint $outpostPoint): void
    {
        $this->pushElement($outpostPoint);
    }

    /**
     * @return OutpostPoint[]
     */
    public function get(): array
    {
        return $this->elements;
    }

}
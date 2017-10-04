<?php
namespace SvyaznoyApi\Collection;

use SvyaznoyApi\Entity\MetroLine;

class MetroLineCollection extends AbstractCollection
{

    public function push(MetroLine $metroLine): void
    {
        $this->pushElement($metroLine);
    }

    /**
     * @return MetroLine[]
     */
    public function get(): array
    {
        return $this->elements;
    }

}
<?php
namespace SvyaznoyApi\Collection;

abstract class AbstractCollection
{

    protected $elements = [];

    protected $totalCount = 0;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param int $totalCount
     */
    final public function setTotalCount(int $totalCount): void
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    final public function pushElement($element): void
    {
        $this->elements[] = $element;
    }

}
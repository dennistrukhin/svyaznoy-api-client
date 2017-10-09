<?php
namespace SvyaznoyApi\Library;

class BasketSumRange
{

    private $min = 0;
    private $max = 0;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

}
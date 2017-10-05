<?php
namespace SvyaznoyApi\Library;

class OutpostWorkTime
{

    private $string = '';
    /** @var TimeInterval[] $days */
    private $days = [];

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @param string $string
     */
    public function setString(string $string): void
    {
        $this->string = $string;
    }

    public function worksOn($dayNumber): bool
    {
        return isset($this->days[$dayNumber]);
    }

    public function getForDay(int $dayNumber): TimeInterval
    {
        return $this->days[$dayNumber];
    }

    public function setDay(int $dayNumber, TimeInterval $interval): void
    {
        $this->days[$dayNumber] = $interval;
    }

}
<?php
namespace SvyaznoyApi\Library;

class TimeInterval
{

    private $timeFrom;
    private $timeTo;

    public function __construct(Time $timeFrom, Time $timeTo)
    {
        $this->timeFrom = $timeFrom;
        $this->timeTo = $timeTo;
    }

    /**
     * @return Time
     */
    public function getTimeFrom(): Time
    {
        return $this->timeFrom;
    }

    /**
     * @return Time
     */
    public function getTimeTo(): Time
    {
        return $this->timeTo;
    }

    public static function makeFromString(string $string): self
    {
        $parts = explode('-', $string);
        $timeFrom = Time::makeFromString($parts[0]);
        $timeTo = Time::makeFromString($parts[1] ?? '');
        $interval = new self($timeFrom, $timeTo);
        return $interval;
    }

}
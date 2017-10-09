<?php
namespace SvyaznoyApi\Library;

class DeliveryDate
{

    private $year = 0;
    private $month = 0;
    private $day = 0;

    public function __construct(int $year, int $month, int $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    public function format(string $format)
    {
        $string = preg_replace('#([^\\\\]|^)Y#', '${1}' . str_pad($this->year, 4, '0', STR_PAD_LEFT), $format);
        $string = preg_replace('#([^\\\\]|^)?m#', '${1}' . str_pad($this->month, 2, '0', STR_PAD_LEFT), $string);
        $string = preg_replace('#([^\\\\]|^)?d#', '${1}' . str_pad($this->day, 2, '0', STR_PAD_LEFT), $string);

        $string = preg_replace('#\\\\#', '', $string);
        return $string;
    }

}
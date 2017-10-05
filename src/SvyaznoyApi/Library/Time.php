<?php
namespace SvyaznoyApi\Library;

class Time
{

    private $hour = 0;
    private $minute = 0;
    private $second = 0;

    public function __construct(int $hour = 0, int $minute = 0, int $second = 0)
    {
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    /**
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }

    /**
     * @return int
     */
    public function getMinute(): int
    {
        return $this->minute;
    }

    /**
     * @return int
     */
    public function getSecond(): int
    {
        return $this->second;
    }

    public static function makeFromString(string $string): self
    {
        $parts = preg_split('#[^\d\s\t\n]+#', $string);
        array_walk($parts, function (&$item) {
            $item = trim($item);
        });
        $hours   = isset($parts[0]) && is_numeric($parts[0]) ? (int)$parts[0] : 0;
        $minutes = isset($parts[1]) && is_numeric($parts[1]) ? (int)$parts[1] : 0;
        $seconds = isset($parts[2]) && is_numeric($parts[2]) ? (int)$parts[2] : 0;
        return new self($hours, $minutes, $seconds);
    }

    public function format(string $format): string
    {
        $string = preg_replace('#([^\\\\]|^)H#', '${1}' . str_pad($this->hour, 2, '0', STR_PAD_LEFT), $format);
        $string = preg_replace('#([^\\\\]|^)?i#', '${1}' . str_pad($this->minute, 2, '0', STR_PAD_LEFT), $string);
        $string = preg_replace('#([^\\\\]|^)?s#', '${1}' . str_pad($this->second, 2, '0', STR_PAD_LEFT), $string);

        $string = preg_replace('#\\\\#', '', $string);
        return $string;
    }

}
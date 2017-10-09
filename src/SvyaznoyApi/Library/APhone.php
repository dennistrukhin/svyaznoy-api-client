<?php
namespace SvyaznoyApi\Library;

abstract class APhone
{

    protected $number = '';

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    public function format(string $formatString): string
    {
        $index = 0;
        $output = '';
        for ($i = 0; $i < strlen($formatString); $i++) {
            if ($formatString[$i] === '#') {
                $output .= $this->number[$index++] ?? '';
            } else {
                $output .= $formatString[$i];
            }
        }
        return $output;
    }

}
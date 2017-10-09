<?php
namespace SvyaznoyApi\HTTP;

class Header
{

    private $name = '';
    private $values = [];

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->values[] = $value;
    }

    public function addValue(string $value)
    {
        $this->values[] = $value;
    }

    public function setValue(string $value)
    {
        $this->values = [
            $value,
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getValues()
    {
        return $this->values;
    }

}
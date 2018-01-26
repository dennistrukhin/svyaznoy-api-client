<?php
namespace SvyaznoyApi\Entity\Registry\Order;

class Owner
{

    private $name = '';
    private $inn;

    public function __construct(string $name, string $inn)
    {
        $this->name = $name;
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

}
<?php
namespace SvyaznoyApi\Library;

class Declension
{

    private $genitive = '';
    private $dative = '';
    private $prepositional = '';

    public function __construct(string $genitive, string $dative, string $prepositional)
    {
        $this->genitive = $genitive;
        $this->dative = $dative;
        $this->prepositional = $prepositional;
    }

    /**
     * @return string
     */
    public function getGenitive(): string
    {
        return $this->genitive;
    }

    /**
     * @return string
     */
    public function getDative(): string
    {
        return $this->dative;
    }

    /**
     * @return string
     */
    public function getPrepositional(): string
    {
        return $this->prepositional;
    }

}
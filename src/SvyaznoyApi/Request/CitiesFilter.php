<?php
namespace SvyaznoyApi\Request;

class CitiesFilter
{

    private $query = '';
    private $available = null;

    /**
     * @param string $query
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
    }

    /**
     * @param null $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return null
     */
    public function getAvailable()
    {
        return $this->available;
    }

}
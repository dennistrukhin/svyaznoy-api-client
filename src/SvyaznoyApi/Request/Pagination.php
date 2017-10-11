<?php
namespace SvyaznoyApi\Request;

class Pagination
{

    const DEFAULT_PAGE_SIZE = 10;
    const DEFAULT_PAGE_NUMBER = 1;

    private $pageSize = self::DEFAULT_PAGE_SIZE;
    private $pageNumber = self::DEFAULT_PAGE_NUMBER;

    public function __construct(int $pageNumber = self::DEFAULT_PAGE_NUMBER, int $pageSize = self::DEFAULT_PAGE_SIZE)
    {
        $this->pageSize = $pageSize;
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function inc()
    {
        $this->pageNumber++;
    }

    public function dec()
    {
        $this->pageNumber--;
    }

}
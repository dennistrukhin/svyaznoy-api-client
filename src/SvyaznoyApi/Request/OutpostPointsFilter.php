<?php
namespace SvyaznoyApi\Request;

class OutpostPointsFilter
{

    private $active = null;
    private $ids = [];

    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }

    public function pushId($id): void
    {
        $this->ids[] = $id;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @return null
     */
    public function getActive()
    {
        return $this->active;
    }

}
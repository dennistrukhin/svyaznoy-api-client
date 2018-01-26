<?php
namespace SvyaznoyApi\Request;

class OrdersFilter
{

    /** @var \DateTime $dtFrom */
    private $dtFrom;
    /** @var \DateTime $dtTo */
    private $dtTo;
    /** @var string[] $ids */
    private $ids = [];

    public function __construct(array $ids = [], ?\DateTime $dtFrom = null, ?\DateTime $dtTo = null)
    {
        $this->ids = $ids;
        $this->dtFrom = $dtFrom;
        $this->dtTo = $dtTo;
    }

    /**
     * @return string[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @return \DateTime
     */
    public function getDtFrom(): \DateTime
    {
        return $this->dtFrom;
    }

    /**
     * @return \DateTime
     */
    public function getDtTo(): \DateTime
    {
        return $this->dtTo;
    }

}
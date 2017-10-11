<?php
namespace SvyaznoyApi\Library;

use SvyaznoyApi\Exception\InvalidArgument;

class OrderResponse
{

    private $id = 0;
    private $partnerOrderNumber = '';
    /** @var \DateTime $insertedAt */
    private $insertedAt;
    /** @var \DateTime $updatedAt */
    private $updatedAt;

    public function __construct(int $id, string $partnerOrderNumber, string $insertedAt, string $updatedAt)
    {
        $this->id = $id;
        $this->partnerOrderNumber = $partnerOrderNumber;
        $dtInsertedAt = \DateTime::createFromFormat(DATE_ISO8601, $insertedAt);
        if (!$dtInsertedAt instanceof \DateTime) {
            throw new InvalidArgument('Связной передал еверный формат даты создания заказа: ' . $insertedAt);
        }
        $dtUpdatedAt = \DateTime::createFromFormat(DATE_ISO8601, $updatedAt);
        if (!$dtUpdatedAt instanceof \DateTime) {
            throw new InvalidArgument('Связной передал еверный формат даты обновления заказа: ' . $dtUpdatedAt);
        }
        $this->insertedAt = $dtInsertedAt;
        $this->updatedAt = $dtUpdatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPartnerOrderNumber(): string
    {
        return $this->partnerOrderNumber;
    }

    /**
     * @return \DateTime
     */
    public function getInsertedAt(): \DateTime
    {
        return $this->insertedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

}
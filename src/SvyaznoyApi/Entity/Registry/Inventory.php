<?php
namespace SvyaznoyApi\Entity\Registry;

class Inventory
{

    private $article;
    private $barcode;
    private $name;
    private $amount;
    private $sum;
    private $clientSum;

    public function __construct(
        string $article,
        string $barcode,
        string $name,
        int $amount,
        float $sum,
        float $clientSum
    )
    {
        $this->article = $article;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->amount = $amount;
        $this->sum = $sum;
        $this->clientSum = $clientSum;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @return float
     */
    public function getClientSum(): float
    {
        return $this->clientSum;
    }

}
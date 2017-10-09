<?php
namespace SvyaznoyApi\Exception;

class UnprocessableEntity extends \Exception
{

    private $messages = [];

    public function __construct($message = "", array $messages = [])
    {
        parent::__construct($message, 422);
        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

}
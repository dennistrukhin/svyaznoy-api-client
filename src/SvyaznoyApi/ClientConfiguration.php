<?php
namespace SvyaznoyApi;

class ClientConfiguration
{

    const MODE_PROD = 'prod';
    const MODE_TEST = 'demo';

    private $username;
    private $password;
    private $mode = self::MODE_TEST;

    public function __construct(string $username, string $password, $mode)
    {
        $this->username = $username;
        $this->password = $password;
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

}
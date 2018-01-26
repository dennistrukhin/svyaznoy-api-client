<?php
namespace SvyaznoyApi;

use Psr\Log\LoggerInterface;
use SvyaznoyApi\TokenStorage\TokenStorageInterface;

class ClientConfiguration
{

    const MODE_PROD = 'prod';
    const MODE_TEST = 'demo';

    private $username;
    private $password;
    private $mode = self::MODE_TEST;
    /** @var TokenStorageInterface $tokenStorage */
    private $tokenStorage;
    /** @var LoggerInterface $logger */
    private $logger;

    public function __construct(
        string $username,
        string $password,
        string $mode,
        ?TokenStorageInterface $tokenStorage = null,
        ?LoggerInterface $logger = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->mode = $mode;
        $this->tokenStorage = $tokenStorage;
        $this->logger = $logger;
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

    /**
     * @return null|TokenStorageInterface
     */
    public function getTokenStorage(): ?TokenStorageInterface
    {
        return $this->tokenStorage;
    }

    /**
     * @return null|LoggerInterface
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

}
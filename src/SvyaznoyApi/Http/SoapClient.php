<?php
namespace SvyaznoyApi\Http;

use Psr\Log\LoggerInterface;
use SvyaznoyApi\Authenticator;
use SvyaznoyApi\AuthenticatorInterface;

class SoapClient implements SoapClientInterface
{

    /** @var Authenticator $authenticator */
    private $authenticator;
    /** @var LoggerInterface $logger */
    private $logger;

    /**
     * Client constructor.
     * @param AuthenticatorInterface $authenticator
     * @param LoggerInterface $logger
     */
    public function __construct(AuthenticatorInterface $authenticator, ?LoggerInterface $logger)
    {
        $this->authenticator = $authenticator;
        $this->logger = $logger;
    }

}
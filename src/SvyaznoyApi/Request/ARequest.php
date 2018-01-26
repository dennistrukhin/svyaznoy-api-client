<?php
namespace SvyaznoyApi\Request;

use Psr\Log\LoggerInterface;
use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Http\HttpClientInterface;

abstract class ARequest
{

    /** @var string $baseUri */
    protected $baseUri = '';
    /** @var Authenticator $authenticator */
    protected $httpClient;
    /** @var LoggerInterface $logger */
    protected $logger;

    public function __construct(string $baseUri, HttpClientInterface $httpClient, ?LoggerInterface $logger)
    {
        $this->baseUri = $baseUri;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

}
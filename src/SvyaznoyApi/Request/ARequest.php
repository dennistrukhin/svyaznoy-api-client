<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;

abstract class ARequest
{

    /** @var string $baseUri */
    protected $baseUri = '';
    /** @var Authenticator $authenticator */
    protected $authenticator;

    public function __construct(string $baseUri, Authenticator $authenticator)
    {
        $this->baseUri = $baseUri;
        $this->authenticator = $authenticator;
    }

}
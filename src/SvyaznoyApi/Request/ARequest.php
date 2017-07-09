<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\ITokenStorage;

abstract class ARequest
{

    /** @var Client $client */
    protected $client;

}
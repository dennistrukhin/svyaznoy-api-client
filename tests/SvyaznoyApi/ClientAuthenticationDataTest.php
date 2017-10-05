<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\ClientAuthenticationData;

class ClientAuthenticationDataTest extends TestCase
{

    public function testConstructor()
    {
        $clientAuthData = new ClientAuthenticationData('name', 'psw');
        $this->assertTrue($clientAuthData->getUsername() === 'name');
        $this->assertTrue($clientAuthData->getPassword() === 'psw');
    }

}
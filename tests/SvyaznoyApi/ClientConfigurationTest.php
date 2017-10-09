<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\ClientConfiguration;

class ClientConfigurationTest extends TestCase
{

    public function testConstructor()
    {
        $clientAuthData = new ClientConfiguration('name', 'psw', ClientConfiguration::MODE_TEST);
        $this->assertTrue($clientAuthData->getUsername() === 'name');
        $this->assertTrue($clientAuthData->getPassword() === 'psw');
        $this->assertTrue($clientAuthData->getMode() === ClientConfiguration::MODE_TEST);
    }

}
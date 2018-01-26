<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\ClientConfiguration;
use SvyaznoyApi\Logger\FileLogger;
use SvyaznoyApi\TokenStorage\TokenStorageMemory;

class ClientConfigurationTest extends TestCase
{

    public function testConstructor()
    {
        $tokenStorage = new TokenStorageMemory();
        $logger = new FileLogger('test');
        $clientConfiguration = new ClientConfiguration(
            'name',
            'psw',
            ClientConfiguration::MODE_TEST,
            $tokenStorage,
            $logger);
        $this->assertTrue($clientConfiguration->getUsername() === 'name');
        $this->assertTrue($clientConfiguration->getPassword() === 'psw');
        $this->assertTrue($clientConfiguration->getMode() === ClientConfiguration::MODE_TEST);
        $this->assertEquals($tokenStorage, $clientConfiguration->getTokenStorage());
        $this->assertEquals($logger, $clientConfiguration->getLogger());
    }

}
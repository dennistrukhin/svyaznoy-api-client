<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Client;
use SvyaznoyApi\ClientAuthenticationData;

class ClientTest extends TestCase
{

    public function testMakeTest()
    {
        $client = Client::getTest(new ClientAuthenticationData('name', 'psw'));
        $this->assertTrue($client->getUsername() === 'name');
        $this->assertTrue($client->getPassword() === 'psw');
        $this->assertTrue($client->getUriApi() === Client::URI_DEMO_API);
        $this->assertTrue($client->getUriAuth() === Client::URI_DEMO_AUTH);
        $this->assertTrue($client->getUriDelivery() === Client::URI_DEMO_DELIVERY);
    }

    public function testMakeProd()
    {
        $client = Client::getProd(new ClientAuthenticationData('name', 'psw'));
        $this->assertTrue($client->getUsername() === 'name');
        $this->assertTrue($client->getPassword() === 'psw');
        $this->assertTrue($client->getUriApi() === Client::URI_PROD_API);
        $this->assertTrue($client->getUriAuth() === Client::URI_PROD_AUTH);
        $this->assertTrue($client->getUriDelivery() === Client::URI_PROD_DELIVERY);
    }

}
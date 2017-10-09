<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Client;
use SvyaznoyApi\ClientConfiguration;

class ClientTest extends TestCase
{

    public function testCreateTest()
    {
        $config = new ClientConfiguration('name', 'psw', ClientConfiguration::MODE_TEST);
        $client = new Client($config);
        $this->assertTrue($client->getConfiguration() === $config);
        $this->assertTrue($client->getUriApi() === Client::URI_DEMO_API);
        $this->assertTrue($client->getUriAuth() === Client::URI_DEMO_AUTH);
        $this->assertTrue($client->getUriDelivery() === Client::URI_DEMO_DELIVERY);
    }

    public function testCreateProd()
    {
        $config = new ClientConfiguration('name', 'psw', ClientConfiguration::MODE_PROD);
        $client = new Client($config);
        $this->assertTrue($client->getConfiguration() === $config);
        $this->assertTrue($client->getUriApi() === Client::URI_PROD_API);
        $this->assertTrue($client->getUriAuth() === Client::URI_PROD_AUTH);
        $this->assertTrue($client->getUriDelivery() === Client::URI_PROD_DELIVERY);
    }

}
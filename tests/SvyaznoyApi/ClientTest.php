<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Client;
use SvyaznoyApi\ClientConfiguration;
use SvyaznoyApi\Request\Cities;
use SvyaznoyApi\Request\Delivery;
use SvyaznoyApi\Request\MetroLines;
use SvyaznoyApi\Request\MetroStations;
use SvyaznoyApi\Request\Orders;
use SvyaznoyApi\Request\OutpostPoints;

class ClientTest extends TestCase
{

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testCitiesMethod()
    {
        $this->assertTrue($this->getDefaultClient()->cities() instanceof Cities);
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testOutpostPointsMethod()
    {
        $this->assertTrue($this->getDefaultClient()->outpostPoints() instanceof OutpostPoints);
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testMetroStationsMethod()
    {
        $this->assertTrue($this->getDefaultClient()->metroStations() instanceof MetroStations);
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testMetroLinesMethod()
    {
        $this->assertTrue($this->getDefaultClient()->metroLines() instanceof MetroLines);
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testDeliveryMethod()
    {
        $this->assertTrue($this->getDefaultClient()->delivery() instanceof Delivery);
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testOrderMethod()
    {
        $this->assertTrue($this->getDefaultClient()->orders() instanceof Orders);
    }

    private function getDefaultClient()
    {
        $config = new ClientConfiguration('name', 'psw', ClientConfiguration::MODE_PROD);
        $client = new Client($config);
        return $client;
    }

}
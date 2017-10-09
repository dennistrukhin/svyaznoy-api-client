<?php
namespace SvyaznoyApi\Tests\HTTP;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\HTTP\Header;

class HeaderTest extends TestCase
{

    public function testConstructor()
    {
        $header = new Header('name', 'value');
        $this->assertTrue($header->getName() === 'name');
        $this->assertTrue(count($header->getValues()) === 1);
        $this->assertTrue($header->getValues()[0] === 'value');
    }

    public function testAddValue()
    {
        $header = new Header('name', 'value1');
        $header->addValue('value2');
        $this->assertTrue(count($header->getValues()) === 2);
        $this->assertTrue($header->getValues()[0] === 'value1');
        $this->assertTrue($header->getValues()[1] === 'value2');
    }

    public function testSetValue()
    {
        $header = new Header('name', 'value1');
        $header->setValue('value2');
        $this->assertTrue(count($header->getValues()) === 1);
        $this->assertTrue($header->getValues()[0] === 'value2');
    }

}
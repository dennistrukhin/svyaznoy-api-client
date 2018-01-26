<?php
namespace SvyaznoyApi\Tests\HTTP;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Http\Header;
use SvyaznoyApi\Http\Headers;

class HeadersTest extends TestCase
{

    public function testAddAndGet()
    {
        $headers = new Headers();
        $this->assertTrue($headers->has('name') === false);
        $this->assertTrue(is_null($headers->get('name')));
        $header = new Header('name', 'value');
        $headers->add($header);
        $this->assertTrue($headers->has('name') === true);
        $this->assertTrue($headers->get('name') instanceof Header);
        $this->assertTrue($headers->get('name')->getName() === 'name');
    }

    public function testRemove()
    {
        $headers = new Headers();
        $header = new Header('name', 'value');
        $headers->add($header);
        $this->assertTrue($headers->has('name') === true);
        $headers->remove('name');
        $this->assertTrue($headers->has('name') === false);
    }

    public function testGetAll()
    {
        $headers = new Headers();
        $header = new Header('name', 'value');
        $headers->add($header);
        $this->assertTrue(is_array($headers->getAll()));
        $this->assertTrue(count($headers->getAll()) === 1);
    }

    public function testGetHttpArray()
    {
        $headers = new Headers();
        $header = new Header('name1', 'value1_1');
        $headers->add($header);
        $header2 = new Header('name2', 'value2_1');
        $headers->add($header2);
        $array = $headers->getHttpArray();
        $this->assertTrue(count($array) === 2);
        $this->assertTrue($array['name1'] === 'value1_1');
        $this->assertTrue($array['name2'] === 'value2_1');
    }

}
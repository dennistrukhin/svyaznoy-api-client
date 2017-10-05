<?php
namespace SvyaznoyApi\Tests\Mock;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mock\Redis;

class RedisTest extends TestCase
{

    public function testSetGet()
    {
        $redis = new Redis();
        $this->assertTrue($redis->get('test') === false);
        $redis->set('test', '123');
        $this->assertTrue($redis->get('test') === '123');
    }

    public function testExists()
    {
        $redis = new Redis();
        $this->assertTrue($redis->exists('test') === false);
        $redis->set('test', '123');
        $this->assertTrue($redis->exists('test') === true);
    }

    public function testSetEx()
    {
        $redis = new Redis();
        $this->assertTrue($redis->exists('test') === false);
        $redis->setex('test', 3600, '123');
        $this->assertTrue($redis->get('test') === '123');
    }

}
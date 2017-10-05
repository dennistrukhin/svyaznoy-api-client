<?php
namespace SvyaznoyApi\Tests;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mock\Redis;
use SvyaznoyApi\TokenStorageRedis;

class TokenStorageTest extends TestCase
{

    const TOKEN_STRING = 'qweasdzxc';

    public function testExists()
    {
        $redis = new Redis();
        $tokenStorage = new TokenStorageRedis($redis);
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING);
        $this->assertTrue($tokenStorage->exists() === true);
    }

    public function testSaveWithoutTtl()
    {
        $redis = new Redis();
        $tokenStorage = new TokenStorageRedis($redis);
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING, 0);
        $this->assertTrue($tokenStorage->get() === self::TOKEN_STRING);
    }

    public function testSaveWithDefaultTtl()
    {
        $redis = new Redis();
        $tokenStorage = new TokenStorageRedis($redis);
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING);
        $this->assertTrue($tokenStorage->get() === self::TOKEN_STRING);
    }

}
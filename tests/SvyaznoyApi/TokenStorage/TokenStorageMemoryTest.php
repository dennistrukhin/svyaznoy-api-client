<?php
namespace SvyaznoyApi\Tests\TokenStorage;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\TokenStorage\TokenStorageMemory;

class TokenStorageMemoryTest extends TestCase
{

    const TOKEN_STRING = 'qweasdzxc';

    public function testExists()
    {
        $tokenStorage = new TokenStorageMemory();
        $this->assertTrue($tokenStorage->exists() === false);
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING);
        $this->assertTrue($tokenStorage->exists() === true);
    }

    public function testSaveWithoutTtl()
    {
        $tokenStorage = new TokenStorageMemory();
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING, 0);
        $this->assertTrue($tokenStorage->get() === self::TOKEN_STRING);
    }

    public function testSaveWithDefaultTtl()
    {
        $tokenStorage = new TokenStorageMemory();
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING);
        $this->assertTrue($tokenStorage->get() === self::TOKEN_STRING);
    }

    public function testSaveWithTtl()
    {
        $tokenStorage = new TokenStorageMemory();
        $this->assertTrue($tokenStorage->get() === false);
        $tokenStorage->save(self::TOKEN_STRING, 2);
        $this->assertTrue($tokenStorage->get() === self::TOKEN_STRING);
        $this->assertTrue($tokenStorage->exists() === true);
        sleep(3);
        $this->assertTrue($tokenStorage->get() === false);
        $this->assertTrue($tokenStorage->exists() === false);
    }

}
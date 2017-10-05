<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\Declension;

class DeclensionTest extends TestCase
{

    public function testConstructorWithParams()
    {
        $declension = new Declension('asd', 'qwe', 'zxc');
        $this->assertTrue($declension->getGenitive() === 'asd', 'Genitive was assigned incorrectly');
        $this->assertTrue($declension->getDative() === 'qwe', 'Dative was assigned incorrectly');
        $this->assertTrue($declension->getPrepositional() === 'zxc', 'Prepositional was assigned incorrectly');
    }

}
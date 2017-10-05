<?php
namespace SvyaznoyApi\Tests\Mapper;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mapper\MetroLineMapper;

class MetroLineMapperTest extends TestCase
{

    const RESPONSE_STRING = <<<HERE
{"id":7944,"name":"\u0421\u043e\u043a\u043e\u043b\u044c\u043d\u0438\u0447\u0435\u0441\u043a\u0430\u044f","color":"FF0A0A","city_id":133}
HERE;


    public function testMap()
    {
        $data = json_decode(self::RESPONSE_STRING, true);
        $mapper = new MetroLineMapper();
        $metroLine = $mapper->map($data);
        $this->assertTrue($metroLine->getId() === $data['id']);
        $this->assertTrue($metroLine->getName() === $data['name']);
        $this->assertTrue($metroLine->getColor() === $data['color']);
        $this->assertTrue($metroLine->getCityId() === $data['city_id']);
    }

}
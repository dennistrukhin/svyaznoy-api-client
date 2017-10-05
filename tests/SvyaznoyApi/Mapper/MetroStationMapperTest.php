<?php
namespace SvyaznoyApi\Tests\Mapper;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mapper\MetroStationMapper;

class MetroStationMapperTest extends TestCase
{

    const RESPONSE_STRING = <<<HERE
{"id":1517022,"name":"\u0410\u0432\u0438\u0430\u043c\u043e\u0442\u043e\u0440\u043d\u0430\u044f","line_id":7952,"city_id":133}
HERE;


    public function testMap()
    {
        $data = json_decode(self::RESPONSE_STRING, true);
        $mapper = new MetroStationMapper();
        $metroLine = $mapper->map($data);
        $this->assertTrue($metroLine->getId() === $data['id']);
        $this->assertTrue($metroLine->getName() === $data['name']);
        $this->assertTrue($metroLine->getLineId() === $data['line_id']);
        $this->assertTrue($metroLine->getCityId() === $data['city_id']);
    }

}
<?php
namespace SvyaznoyApi\Tests\Mapper;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mapper\CityMapper;

class CityMapperTest extends TestCase
{

    const RESPONSE_STRING = <<<HERE
{"id":133,"name":"\u041c\u043e\u0441\u043a\u0432\u0430","alias":"moscow","declension":{"prepositional":"\u041c\u043e\u0441\u043a\u0432\u0435","genitive":"\u041c\u043e\u0441\u043a\u0432\u044b","dative":null},"city_type_id":1,"delivery_type_ids":[1,7,8,9,10,12,13],"payment_type_ids":[1,2,4,6,12,13,14,9,15,11],"rule_priority_id":8,"region_id":1,"zone_id":133,"zone_alias":"","territory_id":50,"kladr_code":"77000000000","time_offset":"+00:00","has_metro":1,"delivery_cost":200,"free_delivery_barier":2000,"delivery_cost_fast":350,"free_delivery_barier_fast":null,"delivery_barriers":{"10":3000,"12":3000,"7":3000,"9":3000},"ymap_longitude":37.620393,"ymap_latitude":55.75396}
HERE;


    public function testMap()
    {
        $data = json_decode(self::RESPONSE_STRING, true);
        $mapper = new CityMapper();
        $city = $mapper->map($data);
        $this->assertTrue($city->getId() == $data['id']);
        $this->assertTrue($city->getName() == $data['name']);
        $this->assertTrue($city->getAlias() == $data['alias']);
        $this->assertTrue(
            $city->getDeclension()->getGenitive() === (string)$data['declension']['genitive'],
            'expected ' . (string)$data['declension']['genitive'] . ' and got ' . $city->getDeclension()->getGenitive()
        );
        $this->assertTrue(
            $city->getDeclension()->getDative() === (string)$data['declension']['dative'],
            'expected ' . (string)$data['declension']['dative'] . ' and got ' . $city->getDeclension()->getDative()
        );
        $this->assertTrue(
            $city->getDeclension()->getPrepositional() === (string)$data['declension']['prepositional'],
            'expected ' . (string)$data['declension']['prepositional'] . ' and got ' . $city->getDeclension()->getPrepositional()
        );
        $this->assertTrue($city->getCityTypeId() === $data['city_type_id']);
        $this->assertTrue($city->getDeliveryTypeIds() === $data['delivery_type_ids']);
        $this->assertTrue($city->getPaymentTypeIds() === $data['payment_type_ids']);
        $this->assertTrue($city->getRulePriorityId() === $data['rule_priority_id']);
        $this->assertTrue($city->getZoneId() === $data['zone_id']);
        $this->assertTrue($city->getTerritoryId() === $data['territory_id']);
        $this->assertTrue($city->getRegionId() === $data['region_id']);
        $this->assertTrue($city->getKladrCode() === $data['kladr_code']);
        $this->assertTrue($city->getTimeOffset() === $data['time_offset']);
        $this->assertTrue($city->hasMetro() === ($data['has_metro'] == 1));
    }

}
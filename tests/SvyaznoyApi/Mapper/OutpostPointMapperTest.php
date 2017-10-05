<?php
namespace SvyaznoyApi\Tests\Mapper;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Mapper\OutpostPointMapper;

class OutpostPointMapperTest extends TestCase
{

    const RESPONSE_STRING = <<<HERE
{"id":1190202,"name":"XL","images":["\/\/static.svyaznoy.ru\/upload\/iblock\/fc1\/11190202.jpeg"],"city_id":136,"active":1,"address":"\u041a\u043e\u043c\u043c\u0443\u043d\u0438\u0441\u0442\u0438\u0447\u0435\u0441\u043a\u0430\u044f \u0443\u043b, \u0434\u043e\u043c \u2116 1, \u0422\u041a XL","station_ids":[15434],"yandex_address":"\u041a\u043e\u043c\u043c\u0443\u043d\u0438\u0441\u0442\u0438\u0447\u0435\u0441\u043a\u0430\u044f \u0443\u043b., \u0434. 1","work_time":{"string":"\u041f\u043d-\u0412\u0441 (10:00-22:00)","array":{"1":{"time_from":"10:00","time_to":"22:00"},"2":{"time_from":"10:00","time_to":"22:00"},"3":{"time_from":"10:00","time_to":"22:00"},"4":{"time_from":"10:00","time_to":"22:00"},"5":{"time_from":"10:00","time_to":"22:00"},"6":{"time_from":"10:00","time_to":"22:00"},"7":{"time_from":"10:00","time_to":"22:00"}}},"work_time_custom":"","longitude":37.748619,"latitude":55.891698,"email":"cms.CR.0202@svyaznoy.ru","directions":"\u0416\/\u0434 \u0441\u0442\u0430\u043d\u0446\u0438\u044f \u00ab\u0422\u0430\u0439\u043d\u0438\u043d\u0441\u043a\u0430\u044f\u00bb. \u0414\u0430\u043b\u0435\u0435 \u043d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u043f\u0440\u043e\u0439\u0442\u0438 \u0447\u0435\u0440\u0435\u0437 \u0447\u0430\u0441\u0442\u043d\u044b\u0439 \u0441\u0435\u043a\u0442\u043e\u0440 \u0434\u043e \u042f\u0440\u043e\u0441\u043b\u0430\u0432\u0441\u043a\u043e\u0433\u043e \u0448\u043e\u0441\u0441\u0435. \u041e\u0440\u0438\u0435\u043d\u0442\u0438\u0440 \u2013 \u00ab\u041a\u0432\u0430-\u041a\u0432\u0430 \u041f\u0430\u0440\u043a\u00bb.","shop_type":2,"has_credit":0,"services":["e_catalog","pay_credit","pay_terminal","setup","trade_in"],"twenty_four_hour":0}
HERE;

    public function testMap()
    {
        $data = json_decode(self::RESPONSE_STRING, true);
        $mapper = new OutpostPointMapper();
        $outpostPoint = $mapper->map($data);
        $this->assertTrue($outpostPoint->getId() === '01190202');
        $this->assertTrue($outpostPoint->getName() === $data['name']);
        $this->assertTrue($outpostPoint->getImages()[0] === $data['images'][0]);
        $this->assertTrue($outpostPoint->getCityId() === $data['city_id']);
        $this->assertTrue($outpostPoint->isActive() === ($data['active'] == '1'));
        $this->assertTrue($outpostPoint->getAddress() === $data['address']);
        $this->assertTrue($outpostPoint->getStationIds()[0] === $data['station_ids'][0]);
        $this->assertTrue($outpostPoint->getYandexAddress() === $data['yandex_address']);
        $this->assertTrue($outpostPoint->getWorkTime()->getString() === $data['work_time']['string']);
        $this->assertTrue($outpostPoint->getWorkTime()->getForDay(1)->getTimeFrom()->format('H:i') === $data['work_time']['array'][1]['time_from']);
        $this->assertTrue($outpostPoint->getWorkTime()->getForDay(1)->getTimeTo()->format('H:i') === $data['work_time']['array'][1]['time_to']);
        $this->assertTrue($outpostPoint->getWorkTimeCustom() === $data['work_time_custom']);
        $this->assertTrue($outpostPoint->getLatitude() === $data['latitude']);
        $this->assertTrue($outpostPoint->getLongitude() === $data['longitude']);
        $this->assertTrue($outpostPoint->getEmail() === $data['email']);
        $this->assertTrue($outpostPoint->getDirections() === $data['directions']);
        $this->assertTrue($outpostPoint->getShopType() === $data['shop_type']);
        $this->assertTrue($outpostPoint->hasCredit() === ($data['has_credit'] == '1'));
        $this->assertTrue($outpostPoint->getServices()[0] === $data['services'][0]);
        $this->assertTrue($outpostPoint->isTwentyFourHour() === ($data['twenty_four_hour'] == '1'));

    }

}
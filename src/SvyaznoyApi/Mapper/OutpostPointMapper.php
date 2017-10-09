<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\OutpostPoint;
use SvyaznoyApi\Library\OutpostWorkTime;
use SvyaznoyApi\Library\Time;
use SvyaznoyApi\Library\TimeInterval;

class OutpostPointMapper
{

    public function map(array $data): OutpostPoint
    {
        $outpostPoint = new OutpostPoint();
        $outpostPoint->setId(str_pad($data['id'], 8, '0', STR_PAD_LEFT));
        $outpostPoint->setName($data['name']);
        if (is_array($data['images'])) {
            $outpostPoint->setImages($data['images']);
        }
        $outpostPoint->setCityId($data['city_id']);
        $outpostPoint->setActive($data['active'] ?? false);
        $outpostPoint->setAddress($data['address'] ?? '');
        if (is_array($data['station_ids'])) {
            $outpostPoint->setStationIds($data['station_ids']);
        }
        $outpostPoint->setYandexAddress($data['yandex_address'] ?? '');
        if (isset($data['work_time'])) {
            $wt = new OutpostWorkTime();
            $wt->setString($data['work_time']['string'] ?? '');
            for ($i = 1; $i <= 7; $i++) {
                if (!empty($data['work_time']['array'][$i])) {
                    $timeFrom = Time::makeFromString($data['work_time']['array'][$i]['time_from']);
                    $timeTo   = Time::makeFromString($data['work_time']['array'][$i]['time_to']);
                    $wt->setDay($i, new TimeInterval($timeFrom, $timeTo));
                }
            }
            $outpostPoint->setWorkTime($wt);
        }
        $outpostPoint->setWorkTimeCustom($data['work_time_custom'] ?? '');
        $outpostPoint->setLatitude($data['latitude'] ?? 0);
        $outpostPoint->setLongitude($data['longitude'] ?? 0);
        $outpostPoint->setEmail($data['email'] ?? '');
        $outpostPoint->setDirections($data['directions'] ?? '');
        $outpostPoint->setShopType($data['shop_type'] ?? 0);
        $outpostPoint->setCredit($data['has_credit'] ?? false);
        $outpostPoint->setServices($data['services'] ?? []);
        $outpostPoint->setTwentyFourHour($data['twenty_four_hour'] ?? false);
        return $outpostPoint;
    }

}
<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\OutpostPoint;

class OutpostPointMapper
{

    public function map(array $data): OutpostPoint
    {
        $outpostPoint = new OutpostPoint();
        if (isset($data['id'])) {
            $outpostPoint->setId(str_pad($data['id'], 8, '0', STR_PAD_LEFT));
        }
        if (isset($data['name'])) {
            $outpostPoint->setName($data['name']);
        }
        if (isset($data['images']) && is_array($data['images'])) {
            $outpostPoint->setImages($data['images']);
        }
        if (isset($data['city_id'])) {
            $outpostPoint->setCityId($data['city_id']);
        }
        if (isset($data['active'])) {
            $outpostPoint->setActive($data['active']);
        }
        if (isset($data['address'])) {
            $outpostPoint->setAddress($data['address']);
        }
        if (isset($data['station_ids']) && is_array($data['station_ids'])) {
            $outpostPoint->setStationIds($data['station_ids']);
        }
        if (isset($data['yandex_address'])) {
            $outpostPoint->setYandxAddress($data['yandex_address']);
        }
        if (isset($data['work_time'])) {
            $outpostPoint->setWorkTime($data['work_time']);
        }
        if (isset($data['work_time_custom'])) {
            $outpostPoint->setWorkTimeCustom($data['work_time_custom']);
        }
        if (isset($data['latitude'])) {
            $outpostPoint->setLatitude($data['latitude']);
        }
        if (isset($data['longitude'])) {
            $outpostPoint->setLongitude($data['longitude']);
        }
        if (isset($data['email'])) {
            $outpostPoint->setEmail($data['email']);
        }
        if (isset($data['directions'])) {
            $outpostPoint->setDirections($data['directions']);
        }
        if (isset($data['shop_type'])) {
            $outpostPoint->setShopType($data['shop_type']);
        }
        if (isset($data['has_credit'])) {
            $outpostPoint->setCredit($data['has_credit']);
        }
        if (isset($data['services'])) {
            $outpostPoint->setServices($data['services']);
        }
        if (isset($data['twenty_four_hour'])) {
            $outpostPoint->setTwentyFourHour($data['twenty_four_hour']);
        }
        return $outpostPoint;
    }

}
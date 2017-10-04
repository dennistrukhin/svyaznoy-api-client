<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\MetroStation;

class MetroStationMapper
{

    public function map(array $data): MetroStation
    {
        $metroStation = new MetroStation();
        if (isset($data['id'])) {
            $metroStation->setId($data['id']);
        }
        if (isset($data['name'])) {
            $metroStation->setName($data['name']);
        }
        if (isset($data['line_id'])) {
            $metroStation->setLineId($data['line_id']);
        }
        if (isset($data['city_id'])) {
            $metroStation->setCityId($data['city_id']);
        }
        return $metroStation;
    }

}
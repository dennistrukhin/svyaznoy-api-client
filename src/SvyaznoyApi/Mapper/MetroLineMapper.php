<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\MetroLine;

class MetroLineMapper
{

    public function map(array $data): MetroLine
    {
        $city = new MetroLine();
        if (isset($data['id'])) {
            $city->setId($data['id']);
        }
        if (isset($data['name'])) {
            $city->setName($data['name']);
        }
        if (isset($data['color'])) {
            $city->setColor($data['color']);
        }
        if (isset($data['city_id'])) {
            $city->setCityId($data['city_id']);
        }
        return $city;
    }

}
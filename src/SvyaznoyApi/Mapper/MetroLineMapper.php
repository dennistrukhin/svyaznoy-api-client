<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\MetroLine;

class MetroLineMapper
{

    public function map(array $data): MetroLine
    {
        $metroLine = new MetroLine();
        if (isset($data['id'])) {
            $metroLine->setId($data['id']);
        }
        if (isset($data['name'])) {
            $metroLine->setName($data['name']);
        }
        if (isset($data['color'])) {
            $metroLine->setColor($data['color']);
        }
        if (isset($data['city_id'])) {
            $metroLine->setCityId($data['city_id']);
        }
        return $metroLine;
    }

}
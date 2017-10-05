<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\City;
use SvyaznoyApi\Library\Declension;

class CityMapper
{

    public function map(array $data): City
    {
        $city = new City();
        if (isset($data['id'])) {
            $city->setId($data['id']);
        }
        if (isset($data['name'])) {
            $city->setName($data['name']);
        }
        if (isset($data['alias'])) {
            $city->setAlias($data['alias']);
        }
        if (isset($data['declension'])) {
            $declension = new Declension(
                $data['declension']['genitive'] ?? '',
                $data['declension']['dative'] ?? '',
                $data['declension']['prepositional'] ?? ''
            );
            $city->setDeclension($declension);
        }
        if (isset($data['city_type_id'])) {
            $city->setCityType($data['city_type_id']);
        }
        if (isset($data['delivery_type_ids'])) {
            $city->setDeliveryTypes($data['delivery_type_ids']);
        }
        if (isset($data['payment_type_ids'])) {
            $city->setPaymentTypes($data['payment_type_ids']);
        }
        if (isset($data['rule_priority_id'])) {
            $city->setRulePriorityId($data['rule_priority_id']);
        }
        if (isset($data['region_id'])) {
            $city->setRegionId($data['region_id']);
        }
        if (isset($data['zone_id']) && is_numeric($data['zone_id'])) {
            $city->setZoneId((int)$data['zone_id']);
        }
        if (isset($data['territory_id'])) {
            $city->setTerritoryId($data['territory_id']);
        }
        if (isset($data['kladr_code'])) {
            $city->setKladrCode($data['kladr_code']);
        }
        if (isset($data['time_offset'])) {
            $city->setTimeOffset($data['time_offset']);
        }
        if (isset($data['has_metro'])) {
            $city->setMetro($data['has_metro']);
        }
        return $city;
    }

}
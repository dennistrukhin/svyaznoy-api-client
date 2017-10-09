<?php
namespace SvyaznoyApi\Mapper;

use SvyaznoyApi\Entity\City;
use SvyaznoyApi\Library\Declension;

class CityMapper
{

    public function map(array $data): City
    {
        $city = new City();
        $city->setId($data['id']);
        $city->setName($data['name']);
        $city->setAlias($data['alias'] ?? '');
        if (isset($data['declension'])) {
            $declension = new Declension(
                $data['declension']['genitive'] ?? '',
                $data['declension']['dative'] ?? '',
                $data['declension']['prepositional'] ?? ''
            );
            $city->setDeclension($declension);
        }
        $city->setCityTypeId($data['city_type_id'] ?? 0);
        $city->setDeliveryTypeIds($data['delivery_type_ids'] ?? []);
        $city->setPaymentTypeIds($data['payment_type_ids'] ?? []);
        $city->setRulePriorityId($data['rule_priority_id'] ?? 0);
        $city->setRegionId($data['region_id'] ?? 0);
        if (isset($data['zone_id']) && is_numeric($data['zone_id'])) {
            $city->setZoneId((int)$data['zone_id']);
        }
        $city->setTerritoryId($data['territory_id'] ?? 0);
        $city->setKladrCode($data['kladr_code'] ?? '');
        $city->setTimeOffset($data['time_offset'] ?? '');
        $city->setMetro($data['has_metro'] ?? false);
        return $city;
    }

}
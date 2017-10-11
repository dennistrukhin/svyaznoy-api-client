<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\DeliveryCollection;
use SvyaznoyApi\HTTP\Client;
use SvyaznoyApi\Mapper\DeliveryMapper;

class Delivery extends ARequest
{

    public function get(DeliveryFilter $filter)
    {
        $httpClient = new Client($this->authenticator);
        $query = [
            'delivery_type_ids' => 9,
            'city_id' => $filter->getCityId(),
            'order_type_id' => 26,
            'products' => [
                [
                    'id' => 2796047,
                    'qty' => 1,
                ],
            ],
        ];
        if (count($filter->getOutpostPointIds()) > 0) {
            $query['shop_ids'] = $filter->getOutpostPointIds();
        }
        if (!is_null($filter->getOrderDate())) {
            $query['order_date'] = $filter->getOrderDate()->getTimestamp();
        }
        $response = $httpClient->get($this->baseUri . '/variations_orders', null, $query);
        $collection = new DeliveryCollection();
        $mapper = new DeliveryMapper();
        foreach ($response->getBody()['items'] as $item) {
            $deliveryItem = $mapper->map($item);
            $collection->push($deliveryItem);
        }
        return $collection;
    }


}
<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Collection\CityCollection;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Mapper\CityMapper;

class Cities extends ARequest
{

    public function get(?CitiesFilter $filter, ?Pagination $pagination)
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        if (!is_null($filter->getAvailable())) {
            $query['available'] = $filter->getAvailable() ? 1 : 0;
        }
        if (!empty($filter->getQuery())) {
            $query['query'] = $filter->getQuery();
        }
        $response = $httpClient->get($this->client->getUriApi() . '/cities', [], $query);
        $collection = new CityCollection();
        $mapper = new CityMapper();
        foreach ($response->getBody() as $item) {
            $city = $mapper->map($item);
            $collection->push($city);
        }
        return $collection;
    }

}
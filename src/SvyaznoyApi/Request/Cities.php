<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\CityCollection;
use SvyaznoyApi\HTTP\Client;
use SvyaznoyApi\Mapper\CityMapper;

class Cities extends ARequest
{

    /**
     * @param null|CitiesFilter $filter
     * @param Pagination $pagination
     * @return CityCollection
     */
    public function get(?CitiesFilter $filter, ?Pagination $pagination)
    {
        if (is_numeric($pagination)) {
            $pagination = new Pagination();
        }
        $httpClient = new Client($this->authenticator);
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        if ($filter instanceof CitiesFilter && !is_null($filter->getAvailable())) {
            $query['available'] = $filter->getAvailable() ? 1 : 0;
        }
        if ($filter instanceof CitiesFilter && !empty($filter->getQuery())) {
            $query['query'] = $filter->getQuery();
        }
        $response = $httpClient->get($this->baseUri . '/cities', [], $query);
        $collection = new CityCollection();
        $collection->setTotalCount($response->getHeader('X-Pagination-Total-Count'));
        $mapper = new CityMapper();
        foreach ($response->getBody() as $item) {
            $city = $mapper->map($item);
            $collection->push($city);
        }
        return $collection;
    }


    /**
     * @param $cityId
     * @return \SvyaznoyApi\Entity\City
     */
    public function getById($cityId)
    {
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get(
            $this->baseUri . '/cities/' . $cityId
        );
        $mapper = new CityMapper();
        $city = $mapper->map($response->getBody());
        return $city;
    }

}
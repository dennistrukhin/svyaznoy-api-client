<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\Collection\CityCollection;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Mapper\CityMapper;

class Cities extends ARequest
{

    private $page = 1;
    private $perPage = 10;
    private $query;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $query
     * @return $this
     */
    public function withQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

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
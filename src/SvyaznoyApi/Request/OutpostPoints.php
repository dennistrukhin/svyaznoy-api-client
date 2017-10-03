<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\Collection\OutpostPointCollection;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Mapper\OutpostPointMapper;

class OutpostPoints extends ARequest
{

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param OutpostPointsFilter|null $filter
     * @param Pagination|null $pagination
     * @return OutpostPointCollection
     */
    public function get(?OutpostPointsFilter $filter = null, ?Pagination $pagination = null)
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        if ($filter->getActive() === true) {
            $query['active'] = 1;
        }
        if (count($filter->getIds())) {
            $query['ids'] = implode(',', $filter->getIds());
        }
        $response = $httpClient->get($this->client->getUriApi() . '/shops', [], $query);
        $collection = new OutpostPointCollection();
        $collection->setTotalCount($response->getHeader('X-Pagination-Total-Count'));
        $mapper = new OutpostPointMapper();
        foreach ($response->getBody() as $item) {
            $outpostPoint = $mapper->map($item);
            $collection->push($outpostPoint);
        }
        return $collection;
    }

}
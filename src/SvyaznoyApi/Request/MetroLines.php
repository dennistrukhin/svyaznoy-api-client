<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Collection\MetroLineCollection;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Mapper\MetroLineMapper;

class MetroLines extends ARequest
{

    /**
     * @return MetroLineCollection
     */
    public function get()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $response = $httpClient->get(
            $this->client->getUriApi() . '/metro/lines'
        );
        $collection = new MetroLineCollection();
        $mapper = new MetroLineMapper();
        foreach ($response->getBody() as $item) {
            $city = $mapper->map($item);
            $collection->push($city);
        }
        return $collection;
    }


}
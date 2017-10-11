<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\MetroLineCollection;
use SvyaznoyApi\HTTP\Client;
use SvyaznoyApi\Mapper\MetroLineMapper;

class MetroLines extends ARequest
{

    /**
     * @return MetroLineCollection
     */
    public function get()
    {
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get($this->baseUri . '/metro/lines');
        $collection = new MetroLineCollection();
        $collection->setTotalCount($response->getHeader('X-Pagination-Total-Count'));
        $mapper = new MetroLineMapper();
        foreach ($response->getBody() as $item) {
            $city = $mapper->map($item);
            $collection->push($city);
        }
        return $collection;
    }

    /**
     * @param $metroLineId
     * @return \SvyaznoyApi\Entity\MetroLine
     */
    public function getById($metroLineId)
    {
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get(
            $this->baseUri . '/metro/lines/' . $metroLineId
        );
        $mapper = new MetroLineMapper();
        $metroLine = $mapper->map($response->getBody());
        return $metroLine;
    }


}
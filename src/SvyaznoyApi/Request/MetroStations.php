<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\MetroStationCollection;
use SvyaznoyApi\HTTP\Client;
use SvyaznoyApi\Mapper\MetroStationMapper;

class MetroStations extends ARequest
{

    /**
     * @param null|MetroStationsFilter $filter
     * @param null|Pagination $pagination
     * @return MetroStationCollection
     */
    public function get(?MetroStationsFilter $filter = null, ?Pagination $pagination = null)
    {
        if (is_null($pagination)) {
            $pagination = new Pagination();
        }
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get($this->baseUri . '/metro/stations', null, $query);
        $collection = new MetroStationCollection();
        $collection->setTotalCount($response->getHeader('X-Pagination-Total-Count'));
        $mapper = new MetroStationMapper();
        foreach ($response->getBody() as $item) {
            $metroStation = $mapper->map($item);
            $collection->push($metroStation);
        }
        return $collection;
    }

    /**
     * @param int $lineId
     * @param null|Pagination $pagination
     * @return MetroStationCollection
     */
    public function getForLine(int $lineId, ?Pagination $pagination = null)
    {
        if (is_null($pagination)) {
            $pagination = new Pagination();
        }
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get(
            $this->baseUri . '/metro/lines/' . $lineId . '/stations', [], $query
        );
        $collection = new MetroStationCollection();
        $collection->setTotalCount($response->getHeader('X-Pagination-Total-Count'));
        $mapper = new MetroStationMapper();
        foreach ($response->getBody() as $item) {
            $metroStation = $mapper->map($item);
            $collection->push($metroStation);
        }
        return $collection;
    }

    /**
     * @param int $stationId
     * @return \SvyaznoyApi\Entity\MetroStation
     */
    public function getById(int $stationId)
    {
        $httpClient = new Client($this->authenticator);
        $response = $httpClient->get(
            $this->baseUri . '/metro/stations/' . $stationId
        );
        $mapper = new MetroStationMapper();
        $metroStation = $mapper->map($response->getBody());
        return $metroStation;
    }


}
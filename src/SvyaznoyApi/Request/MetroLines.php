<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\MetroLineCollection;
use SvyaznoyApi\Mapper\MetroLineMapper;

class MetroLines extends ARequest
{

    /**
     * @return MetroLineCollection
     */
    public function get()
    {
        $response = $this->httpClient->get($this->baseUri . '/metro/lines');
        $collection = new MetroLineCollection();
        $collection->setTotalCount($response->getHeaderItem('X-Pagination-Total-Count', 0));
        $mapper = new MetroLineMapper();
        foreach ($response->getBody() as $item) {
            $metroLine = $mapper->map($item);
            $collection->push($metroLine);
        }
        return $collection;
    }

    /**
     * @param $metroLineId
     * @return \SvyaznoyApi\Entity\MetroLine
     */
    public function getById($metroLineId)
    {
        $response = $this->httpClient->get(
            $this->baseUri . '/metro/lines/' . $metroLineId
        );
        $mapper = new MetroLineMapper();
        $metroLine = $mapper->map($response->getBody());
        return $metroLine;
    }


}
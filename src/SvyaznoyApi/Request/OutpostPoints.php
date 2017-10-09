<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Collection\OutpostPointCollection;
use SvyaznoyApi\HTTP\Client as HttpClient;
use SvyaznoyApi\Mapper\OutpostPointMapper;

class OutpostPoints extends ARequest
{

    /**
     * @param OutpostPointsFilter|null $filter
     * @param Pagination|null $pagination
     * @return OutpostPointCollection
     */
    public function get(?OutpostPointsFilter $filter = null, ?Pagination $pagination = null)
    {
        if (is_null($pagination)) {
            $pagination = new Pagination();
        }
        $httpClient = new HttpClient($this->authenticator);
        $query = [
            'page' => $pagination->getPageNumber(),
            'per_page' => $pagination->getPageSize(),
        ];
        if ($filter instanceof OutpostPointsFilter && $filter->getActive() === true) {
            $query['active'] = 1;
        }
        if ($filter instanceof OutpostPointsFilter && count($filter->getIds())) {
            $query['ids'] = implode(',', $filter->getIds());
        }
        $response = $httpClient->get($this->baseUri . '/shops', null, $query);
        $collection = new OutpostPointCollection();
        $collection->setTotalCount($response->getHeaderItem('X-Pagination-Total-Count', 0));
        $mapper = new OutpostPointMapper();
        foreach ($response->getBody() as $item) {
            $outpostPoint = $mapper->map($item);
            $collection->push($outpostPoint);
        }
        return $collection;
    }

}
<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class Delivery extends ARequest
{

    private $params = [
        'owner' => 'site',
        'did' => [9],
        'pid' => [2796047 => ''],
        'ot' => 26
    ];

    public function inCity($cityId)
    {
        $this->params['lid'] = $cityId;
        return $this;
    }

    public function forPayment($paymentId)
    {
        $this->params['payment_type'] = $paymentId;
        return $this;
    }

    public function shippedOn(\DateTime $dateTime)
    {
        $this->params['cd'] = $dateTime->getTimestamp();
        return $this;
    }

    public function toOutpostPoint($outpostPointId)
    {
        $this->params['tp'] = $outpostPointId;
        return $this;
    }

    public function get()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $response = $httpClient->get(
            $this->client->getUriDelivery() . '/apps/delivery/calc/',
            [],
            $this->params
        );
        return new Response($response);
    }


}
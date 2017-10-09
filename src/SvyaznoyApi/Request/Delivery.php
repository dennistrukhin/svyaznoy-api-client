<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\Client;
use SvyaznoyApi\Response;

class Delivery extends ARequest
{

    private $params = [
        'owner' => 'site',
        'did' => [9],
        'pid' => [2796047 => ''],
        'ot' => 26
    ];

    public function get()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new Client($authenticator);
        $response = $httpClient->get(
            $this->client->getUriDelivery() . '/apps/delivery/calc/',
            [],
            $this->params
        );
        return new Response($response);
    }


}
<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class City extends ARequest
{

    private $id;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     * @return $this
     * @internal param mixed $query
     */
    public function withId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function get()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $response = $httpClient->get(
            $this->client->getUriApi() . '/cities/' . $this->id
        );
        return new Response($response);
    }


}
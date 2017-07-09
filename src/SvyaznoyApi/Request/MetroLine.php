<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class MetroLine extends ARequest
{

    private $id;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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
            $this->client->getUriApi() . '/metro/lines/' . $this->id
        );
        return new Response($response);
    }


}
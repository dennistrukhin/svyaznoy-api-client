<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class MetroLineStations extends ARequest
{

    private $id;
    private $page = 1;
    private $perPage = 10;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function withId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function get()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $response = $httpClient->get(
            $this->client->getUriApi() . '/metro/lines/' . $this->id . '/stations',
            [],
            ['page' => $this->page, 'per_page' => $this->perPage]
        );
        return new Response($response);
    }


}
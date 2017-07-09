<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class OutpostPoints extends ARequest
{

    private $page = 1;
    private $perPage = 10;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
            $this->client->getUriApi() . '/shops',
            [],
            ['page' => $this->page, 'per_page' => $this->perPage]
        );
        return new Response($response);
    }


}
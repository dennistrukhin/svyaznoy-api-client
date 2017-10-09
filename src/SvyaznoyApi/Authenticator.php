<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Exception\Unauthorized;
use SvyaznoyApi\HTTP\Curl;

class Authenticator
{

    /** @var Client $client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getToken()
    {
        if ($this->client->getTokenStorage() instanceof ITokenStorage && $this->client->getTokenStorage()->exists()) {
            return $this->client->getTokenStorage()->get();
        } else {
            return $this->refreshToken();
        }
    }

    public function refreshToken()
    {
        $ch = new Curl(Curl::METHOD_POST, $this->client->getUriAuth() . '/access_token');
        $ch->setParams([
            'grant_type' => 'client_credentials',
            'client_id' => $this->client->getConfiguration()->getUsername(),
            'client_secret' => $this->client->getConfiguration()->getPassword(),
        ]);
        $response = $ch->execute();
        $body = $response->getBody();
        if ($response->getStatusCode() !== 200) {
            throw new Unauthorized($body['error_description'] ?? 'Undefined error');
        }
        $token = $body['access_token'];
        if ($this->client->getTokenStorage() instanceof ITokenStorage && !empty($token)) {
            $this->client->getTokenStorage()->save($token);
        }
        return $token;
    }

}
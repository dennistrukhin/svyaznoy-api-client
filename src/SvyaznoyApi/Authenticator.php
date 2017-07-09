<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Exception\Unauthorized;

class Authenticator
{

    /** @var Client $client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->client->getUriAuth() . '/access_token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => $this->client->getUsername(),
            'client_secret' => $this->client->getPassword()
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        $serverOutput = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = json_decode(substr($serverOutput, $headerSize));
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new Unauthorized(isset($body->error_description) ? $body->error_description : '');
        }
        $token = $body->access_token;
        if ($this->client->getTokenStorage() instanceof ITokenStorage && !empty($token)) {
            $this->client->getTokenStorage()->save($token);
        }
        return $token;
    }

}
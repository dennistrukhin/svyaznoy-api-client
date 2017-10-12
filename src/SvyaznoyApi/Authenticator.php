<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Exception\Unauthorized;
use SvyaznoyApi\HTTP\Curl;
use SvyaznoyApi\HTTP\Header;
use SvyaznoyApi\HTTP\Request;

class Authenticator
{

    const TYPE_HEADER = 'header';
    const TYPE_GET_PARAM = 'get_param';

    /** @var Client $client */
    private $client;
    private $authType = self::TYPE_GET_PARAM;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setAuthType(string $authType): void
    {
        $this->authType = $authType;
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
        $request = new Request(
            Request::METHOD_POST,
            $this->client->getUriAuth() . '/access_token',
            null,
            [
                'grant_type' => 'client_credentials',
                'client_id' => $this->client->getConfiguration()->getUsername(),
                'client_secret' => $this->client->getConfiguration()->getPassword(),
            ]
        );
        $response = (new Curl())->execute($request);
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

    public function addAuthData(Request $request)
    {
        if ($this->authType === self::TYPE_HEADER) {
            $request->getHeaders()->add(new Header('Authorization', 'Bearer ' . $this->getToken()));
        } else {
            $request->setParam('access_token', $this->getToken());
        }
    }

}
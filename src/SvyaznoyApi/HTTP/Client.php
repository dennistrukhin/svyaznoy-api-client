<?php
namespace SvyaznoyApi\HTTP;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Exception\Unauthorized;

class Client
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /** @var Authenticator $authenticator */
    private $authenticator;

    private $maxAttempts = 3;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function get($uri, ?Headers $headers = null, $params = [])
    {
        return $this->send(self::METHOD_GET, $uri, $headers, $params);
    }

    public function post($uri, $headers = [], $params = [])
    {
        return $this->send(self::METHOD_POST, $uri, $headers, $params);
    }

    private function send($method, $uri, ?Headers $headers = null, array $params = [])
    {
        if (is_null($headers)) {
            $headers = new Headers();
        }
        $ch = new Curl($method, $uri);
        $ch->setParams($params);
        for ($attempt = 0; $attempt < $this->maxAttempts; $attempt++) {
            $token = $this->authenticator->getToken();
            $headers->add(new Header('Authorization', 'Bearer ' . $token));
            $ch->setHeaders($headers);
            $response = $ch->execute();
            if ($response->getStatusCode() == 401) {
                $this->authenticator->refreshToken();
                continue;
            }
            return $response;
        }
        throw new Unauthorized('Невозможно авторизоваться у Связного');
    }

}
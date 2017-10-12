<?php
namespace SvyaznoyApi\HTTP;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Exception\Unauthorized;
use SvyaznoyApi\Exception\Unreachable;
use SvyaznoyApi\Exception\Unrecoverable;

class Client
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /** @var Authenticator $authenticator */
    private $authenticator;

    private $maxAttempts = 3;

    /**
     * Client constructor.
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @return Response
     */
    public function get($uri, ?Headers $headers = null, $params = []): Response
    {
        return $this->send(self::METHOD_GET, $uri, $headers, $params);
    }

    /**
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @return Response
     */
    public function post($uri, ?Headers $headers = null, $params = []): Response
    {
        return $this->send(self::METHOD_POST, $uri, $headers, $params);
    }

    /**
     * @param $method
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @return Response
     * @throws Unauthorized
     * @throws Unreachable
     * @throws Unrecoverable
     */
    private function send($method, $uri, ?Headers $headers = null, array $params = []): Response
    {
        for ($attempt = 0; $attempt < $this->maxAttempts; $attempt++) {
            $request = new Request($method, $uri, $headers, $params);
            $this->authenticator->addAuthData($request);
            $response = (new Curl())->execute($request);
            if ($response->getStatusCode() == 401) {
                $this->authenticator->refreshToken();
                continue;
            }
            if (in_array($response->getStatusCode(), [200, 201, 204, 422])) {
                break;
            }
        }
        if (!isset($response) || !$response instanceof Response) {
            throw new Unreachable('Невозможно получить ответ от удалённого сервиса.');
        }
        switch ($response->getStatusCode()) {
            case 401:
                throw new Unauthorized('Невозможно авторизоваться у Связного');
            case 500:
                throw new Unrecoverable('Удалённый сервис вернул критическую ошибку');
        }
        return $response;
    }

}
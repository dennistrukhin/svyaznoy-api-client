<?php
namespace SvyaznoyApi\Http;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use SvyaznoyApi\Authenticator;
use SvyaznoyApi\AuthenticatorInterface;
use SvyaznoyApi\Exception\Unauthorized;
use SvyaznoyApi\Exception\Unreachable;
use SvyaznoyApi\Exception\Unrecoverable;

class HttpClient implements HttpClientInterface
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /** @var Authenticator $authenticator */
    private $authenticator;
    /** @var LoggerInterface $logger */
    private $logger;
    /** @var Client $client */
    private $client;

    private $maxAttempts = 3;

    /**
     * Client constructor.
     * @param AuthenticatorInterface $authenticator
     * @param Client $client
     * @param null|LoggerInterface $logger
     */
    public function __construct(AuthenticatorInterface $authenticator, Client $client, ?LoggerInterface $logger)
    {
        $this->authenticator = $authenticator;
        $this->logger = $logger;
        $this->client = $client;
    }

    /**
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @return Response
     * @throws Unauthorized
     * @throws Unreachable
     * @throws Unrecoverable
     */
    public function get($uri, ?Headers $headers = null, $params = []): Response
    {
        return $this->send(self::METHOD_GET, $uri, $headers, $params);
    }

    /**
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @param string $body
     * @return Response
     * @throws Unauthorized
     * @throws Unreachable
     * @throws Unrecoverable
     */
    public function post($uri, ?Headers $headers = null, $params = [], string $body = ''): Response
    {
        return $this->send(self::METHOD_POST, $uri, $headers, $params, $body);
    }

    /**
     * @param $method
     * @param $uri
     * @param null|Headers $headers
     * @param array $params
     * @param string $body
     * @return Response
     * @throws Unauthorized
     * @throws Unreachable
     * @throws Unrecoverable
     */
    private function send($method, $uri, ?Headers $headers = null, array $params = [], string $body = ''): Response
    {
        $requestOptions = $this->getRequestOptions($method, $headers, $params, $body);
        for ($attempt = 0; $attempt < $this->maxAttempts; $attempt++) {
            $token = $this->authenticator->getToken();
            $requestOptions[RequestOptions::QUERY]['access_token'] = $token;
            $requestOptions[RequestOptions::HEADERS]['Authorization'] = 'Bearer ' . $token;
            $responseData = $this->client->request($method, $uri, $requestOptions);
            $response = Response::makeFromGuzzleResponse($responseData);
            if ($response->getStatusCode() == 401) {
                if ($this->logger instanceof LoggerInterface) {
                    $this->logger->info('Токен не валиден, нужно получить новый');
                }
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
            case 403:
                throw new Unauthorized('Невозможно авторизоваться у Связного');
            case 500:
            case 502:
            case 503:
            case 504:
                throw new Unrecoverable('Удалённый сервис вернул критическую ошибку');
        }
        return $response;
    }


    /**
     * @param $method
     * @param null|Headers $headers
     * @param array $params
     * @param string $body
     * @return array
     */
    private function getRequestOptions($method, ?Headers $headers = null, array $params = [], string $body = ''): array
    {
        $requestOptions = [
            RequestOptions::QUERY => [],
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::TIMEOUT => 10,
        ];
        if (!empty($body)) {
            $requestOptions[RequestOptions::BODY] = $body;
        }
        if (!is_null($headers)) {
            $requestOptions[RequestOptions::HEADERS] = $headers->getHttpArray();
        }
        if (count($params)) {
            if ($method === self::METHOD_POST) {
                $requestOptions[RequestOptions::FORM_PARAMS] = $params;
            } else {
                $requestOptions[RequestOptions::QUERY] = $params;
            }
        }
        return $requestOptions;
    }

}
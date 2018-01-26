<?php
namespace SvyaznoyApi;

use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use SvyaznoyApi\Exception\Unauthorized;
use SvyaznoyApi\Http\Header;
use SvyaznoyApi\Http\Request;
use SvyaznoyApi\Http\Response;
use SvyaznoyApi\TokenStorage\TokenStorageInterface;

class Authenticator implements AuthenticatorInterface
{

    const TYPE_HEADER = 'header';
    const TYPE_GET_PARAM = 'get_param';

    private $uri = '';
    private $username = '';
    private $password = '';
    /** @var TokenStorageInterface $tokenStorage */
    private $tokenStorage;
    /** @var \GuzzleHttp\Client $client */
    private $client;
    private $authType = self::TYPE_GET_PARAM;
    /**
     * @var null|LoggerInterface
     */
    private $logger;

    /**
     * Authenticator constructor.
     * @param string $uri
     * @param string $username
     * @param string $password
     * @param \GuzzleHttp\Client $client
     * @param null|TokenStorageInterface $tokenStorage
     * @param null|LoggerInterface $logger
     */
    public function __construct(string $uri, string $username, string $password, \GuzzleHttp\Client $client, ?TokenStorageInterface $tokenStorage, ?LoggerInterface $logger)
    {
        $this->uri = $uri;
        $this->username = $username;
        $this->password = $password;
        $this->client = $client;
        $this->tokenStorage = $tokenStorage;
        $this->logger = $logger;
    }

    public function setAuthType(string $authType): void
    {
        $this->authType = $authType;
    }

    /**
     * @return mixed
     * @throws Unauthorized
     */
    public function getToken()
    {
        if ($this->tokenStorage instanceof TokenStorageInterface && $this->tokenStorage->exists()) {
            $token = $this->tokenStorage->get();
            if ($this->logger instanceof LoggerInterface) {
                $this->logger->info('Токен получен из локального хранилища: ' . $token );
            }
            return $token;
        } else {
            if ($this->logger instanceof LoggerInterface) {
                $this->logger->info('Необходимо получить токен от Связного');
            }
            $token = $this->refreshToken();
            if ($this->logger instanceof LoggerInterface) {
                $this->logger->info('Получен токен от Связного: ' . $token);
            }
            return $token;
        }
    }

    /**
     * @return mixed
     * @throws Unauthorized
     */
    public function refreshToken()
    {
        $responseData = $this->client->post($this->uri . '/access_token', [
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->username,
                'client_secret' => $this->password,
            ],
        ]);
        $response = Response::makeFromGuzzleResponse($responseData);
        $body = $response->getBody();
        if ($response->getStatusCode() !== 200) {
            throw new Unauthorized($body['error_description'] ?? 'Undefined error');
        }
        $token = $body['access_token'];
        if ($this->tokenStorage instanceof TokenStorageInterface && !empty($token)) {
            $this->tokenStorage->save($token);
        }
        return $token;
    }

    /**
     * @param Request $request
     * @throws Unauthorized
     */
    public function addAuthData(Request $request)
    {
        if ($this->authType === self::TYPE_HEADER) {
            $request->getHeaders()->add(new Header('Authorization', 'Bearer ' . $this->getToken()));
        } else {
            $request->setParam('access_token', $this->getToken());
        }
    }

}
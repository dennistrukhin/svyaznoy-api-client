<?php
namespace SvyaznoyApi;

use DI\Container;
use DI\ContainerBuilder;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\CachingStream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SvyaznoyApi\Http\HttpClient;
use SvyaznoyApi\Http\HttpClientInterface;
use SvyaznoyApi\Http\SoapClient;
use SvyaznoyApi\Http\SoapClientInterface;
use SvyaznoyApi\Request\Cities as CitiesRequest;
use SvyaznoyApi\Request\Delivery as DeliveryRequest;
use SvyaznoyApi\Request\MetroStations as MetroStationsRequest;
use SvyaznoyApi\Request\MetroLines as MetroLinesRequest;
use SvyaznoyApi\Request\Orders as OrderRequest;
use SvyaznoyApi\Request\OutpostPoints as OutpostPointsRequest;
use SvyaznoyApi\Request\Registry as RegistryRequest;
use SvyaznoyApi\TokenStorage\TokenStorageInterface;

class Client
{

    const URI_PROD_AUTH = 'https://auth.svyaznoy.ru';
    const URI_PROD_API = 'https://api.svyaznoy.ru/v1';
    const URI_PROD_ORDERS_SOAP = 'https://api.svyaznoy.ru/v3';

    const URI_DEMO_AUTH = 'http://auth.sandbox.dev.svyaznoy.ru';
    const URI_DEMO_API = 'http://api.sandbox.dev.svyaznoy.ru/v1';
    const URI_DEMO_ORDERS_SOAP = 'http://api.sandbox.dev.svyaznoy.ru/v3';

    /** @var ClientConfiguration $configuration */
    private $configuration;
    private $uriAuth;
    private $uriApi;
    private $uriOrdersSoap;
    /** @var \DI\Container $container */
    private $container;
    private $sessionId;

    /**
     * Client constructor.
     * @param ClientConfiguration $clientConfiguration
     * @throws \Exception
     */
    public function __construct(ClientConfiguration $clientConfiguration)
    {
        $this->sessionId = bin2hex(random_bytes(16));
        $this->configuration = $clientConfiguration;
        if ($this->configuration->getLogger() instanceof LoggerInterface) {
            $this->configuration->getLogger()->info('Starting session ' . $this->sessionId);
        }
        switch ($this->configuration->getMode()) {
            case ClientConfiguration::MODE_TEST:
                $this->uriAuth = self::URI_DEMO_AUTH;
                $this->uriApi = self::URI_DEMO_API;
                $this->uriOrdersSoap = self::URI_DEMO_ORDERS_SOAP;
                break;
            case ClientConfiguration::MODE_PROD:
                $this->uriAuth = self::URI_PROD_AUTH;
                $this->uriApi = self::URI_PROD_API;
                $this->uriOrdersSoap = self::URI_PROD_ORDERS_SOAP;
                break;
        }
        $this->container = $this->buildContainer();
    }

    /**
     * @return Container
     */
    private function buildContainer(): Container
    {
        $builder = new ContainerBuilder();
        $clientConfig = [];
        if ($this->configuration->getLogger() instanceof LoggerInterface) {
            $logger = $this->configuration->getLogger();
            $handlerStack = HandlerStack::create();
            $handlerStack->push(Middleware::log($logger, new MessageFormatter('RESPONSE: {code} - {res_body}')));
            $handlerStack->push(Middleware::log($logger, new MessageFormatter('{method} {uri} HTTP/{version} {request}')));
            $clientConfig['handler'] = $handlerStack;
        }
        $definitions = [
            LoggerInterface::class => $this->configuration->getLogger(),
            AuthenticatorInterface::class => \DI\object(Authenticator::class)
                ->constructorParameter('uri', $this->uriAuth)
                ->constructorParameter('username', $this->configuration->getUsername())
                ->constructorParameter('password', $this->configuration->getPassword()),
            CitiesRequest::class => \DI\object(CitiesRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            DeliveryRequest::class => \DI\object(DeliveryRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            MetroLinesRequest::class => \DI\object(MetroLinesRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            MetroStationsRequest::class => \DI\object(MetroStationsRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            OrderRequest::class => \DI\object(OrderRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            OutpostPointsRequest::class => \DI\object(OutpostPointsRequest::class)
                ->constructorParameter('baseUri', $this->uriApi),
            RegistryRequest::class => \DI\object(RegistryRequest::class)
                ->constructorParameter('baseUri', $this->uriOrdersSoap),
            \GuzzleHttp\Client::class => \DI\object(\GuzzleHttp\Client::class)
                ->constructorParameter('config', $clientConfig),
            HttpClientInterface::class => \DI\object(HttpClient::class),
            SoapClientInterface::class => \DI\object(SoapClient::class),
            TokenStorageInterface::class => $this->configuration->getTokenStorage(),
        ];
        $builder->addDefinitions($definitions);
        return $builder->build();
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Метод возвращает список городов
     * @return CitiesRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function cities()
    {
        return $this->container->get(CitiesRequest::class);
    }

    /**
     * @return mixed|OutpostPointsRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function outpostPoints()
    {
        return $this->container->get(OutpostPointsRequest::class);
    }

    /**
     * @return mixed|MetroStationsRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function metroStations()
    {
        return $this->container->get(MetroStationsRequest::class);
    }

    /**
     * @return mixed|MetroLinesRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function metroLines()
    {
        return $this->container->get(MetroLinesRequest::class);
    }

    /**
     * @return mixed|DeliveryRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function delivery()
    {
        return $this->container->get(DeliveryRequest::class);
    }

    /**
     * @return mixed|OrderRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function orders()
    {
        return $this->container->get(OrderRequest::class);
    }

    /**
     * @return mixed|RegistryRequest
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function registry()
    {
        return $this->container->get(RegistryRequest::class);
    }

    public function __destruct()
    {
        if ($this->configuration->getLogger() instanceof LoggerInterface) {
            $this->configuration->getLogger()->info('Ending session ' . $this->sessionId);
        }
    }

}
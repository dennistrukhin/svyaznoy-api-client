<?php
namespace SvyaznoyApi\HTTP;

class Request
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    private $method;
    private $url;
    /** @var Headers $headers */
    private $headers;
    private $params = [];

    public function __construct(string $method, string $uri, ?Headers $headers = null, array $params = [])
    {
        $this->method = $method;
        $this->url = $uri;
        $this->headers = is_null($headers) ? new Headers() : $headers;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return Headers
     */
    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    /**
     * @param Headers $headers
     */
    public function setHeaders(Headers $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

}
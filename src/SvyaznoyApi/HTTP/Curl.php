<?php
namespace SvyaznoyApi\HTTP;

class Curl
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    private $ch;
    private $url = '';
    private $data = [];
    private $method;
    /** @var Headers $headers */
    private $headers;

    public function __construct($method, $url)
    {
        $this->ch = curl_init();
        $this->url = $url;
        $this->method = $method;
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        $this->headers = new Headers();
    }

    public function setHeaders(Headers $headers)
    {
        $this->headers = $headers;
    }

    public function setParams(array $params)
    {
        $this->data = $params;
        if (count($this->data) > 0) {
            $postFields = http_build_query($this->data);
            if ($this->method === self::METHOD_POST) {
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                $this->url .= '?' . $postFields;
            }
        }
    }

    public function execute()
    {
        if ($this->method === self::METHOD_POST) {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            if (!$this->headers->has('Content-Type')) {
                $this->headers->add(new Header('Content-Type', 'application/x-www-form-urlencoded'));
            }
        }
        $headersToSend = $this->headers->getHttpArray();
        if (count($headersToSend) > 0) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headersToSend);
        }
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        return new Response(curl_exec($this->ch));
    }

}
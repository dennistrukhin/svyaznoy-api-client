<?php
namespace SvyaznoyApi\HTTP;

class Curl
{

    const METHOD_POST = 'POST';

    private $ch;
    private $url = '';
    /** @var Headers $headers */
    private $headers;

    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        $this->headers = new Headers();
    }

    public function execute(Request $request)
    {
        $this->url = $request->getUrl();
        if (!is_null($request->getHeaders())) {
            $this->headers = $request->getHeaders();
        }
        if ($request->getMethod() === self::METHOD_POST) {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            if (!$this->headers->has('Content-Type')) {
                $this->headers->add(new Header('Content-Type', 'application/x-www-form-urlencoded'));
            }
        }
        $headersToSend = $this->headers->getHttpArray();
        if (count($headersToSend) > 0) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headersToSend);
        }
        if (count($request->getParams()) > 0) {
            $postFields = http_build_query($request->getParams());
            if ($request->getMethod() === self::METHOD_POST) {
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                $this->url .= '?' . $postFields;
            }
        }
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        $responseString = curl_exec($this->ch);
        return new Response($responseString);
    }

}
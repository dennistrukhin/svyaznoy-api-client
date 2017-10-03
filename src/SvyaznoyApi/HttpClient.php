<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Exception\Unauthorized;

class HttpClient
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

    public function get($uri, $headers = [], $params = [])
    {
        return $this->send(self::METHOD_GET, $uri, $headers, $params);
    }

    public function post($uri, $headers = [], $params = [])
    {
        return $this->send(self::METHOD_POST, $uri, $headers, $params);
    }

    private function send($method, $uri, $headers, $params)
    {
        $ch = curl_init();
        if ($method === self::METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        if (count($params) > 0) {
            $postFields = http_build_query($params);
            if ($method === self::METHOD_POST) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                if (empty($headers['Content-Type'])) {
                    $headers['Content-Type'] = 'application/x-www-form-urlencoded';
                }
            } else {
                $uri .= '?' . $postFields;
            }
        }
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        for ($attempt = 0; $attempt < $this->maxAttempts; $attempt++) {
            $token = $this->authenticator->getToken();
            $headers['Authorization'] = 'Bearer ' . $token;
            if (count($headers) > 0) {
                $headersToSend = [];
                foreach ($headers as $headerName => $headerValue) {
                    $headersToSend[] = $headerName . ': ' . $headerValue;
                }
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headersToSend);
            }

            $serverOutput = curl_exec($ch);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerString = substr($serverOutput, 0, $headerSize);
            $body = substr($serverOutput, $headerSize);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode == 401) {
                $this->authenticator->refreshToken();
                continue;
            }

            $headersArray = explode("\r\n", $headerString);
            $responseHeaders = [];
            if (count($headersArray) > 0) {
                foreach ($headersArray as $header) {
                    if (strpos($header, ':') !== false) {
                        list($headerName, $headerValue) = explode(':', $header);
                        $responseHeaders[trim($headerName)] = trim($headerValue);
                    }
                }
            }

            return new Response($httpCode, $responseHeaders, json_decode($body, true));
        }
        throw new Unauthorized('Невозможно авторизоваться у Связного');
    }

}
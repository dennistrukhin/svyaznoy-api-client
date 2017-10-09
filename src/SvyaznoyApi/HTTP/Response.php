<?php
namespace SvyaznoyApi\HTTP;

class Response
{

    private $statusCode = 0;
    private $statusText = '';
    private $headers;
    private $body;

    public function __construct($responseText)
    {
        list($headersText, $bodyText) = preg_split('#\r\n\r\n#', $responseText, 2);
        $headerStrings = preg_split('#\r\n#', $headersText);
        $headers = [];
        $statusString = array_shift($headerStrings);
        preg_match('#^HTTP/\d.\d\s(\d{3})\s*(.*)$#', $statusString, $matches);
        $this->statusCode = (int)$matches[1];
        $this->statusText = (string)$matches[2];
        foreach ($headerStrings as $headerString) {
            list($key, $value) = preg_split('#:#', $headerString, 2);
            $key = trim($key);
            $value = trim($value);
            if (!isset($headers[$key])) {
                $headers[$key] = [];
            }
            $headers[$key][] = $value;
        }
        $this->headers = $headers;
        $this->body = json_decode($bodyText, true);
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getStatusText(): string
    {
        return $this->statusText;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHeader($name)
    {
        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }
        return null;
    }

    public function getHeaderItem($name, $index)
    {
        if (isset($this->headers[$name][$index])) {
            return $this->headers[$name][$index];
        }
        return null;
    }

}
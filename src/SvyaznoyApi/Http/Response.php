<?php
namespace SvyaznoyApi\Http;

use Psr\Http\Message\ResponseInterface;

class Response implements \JsonSerializable
{

    private $statusCode = 0;
    private $statusText = '';
    private $headers;
    private $body;


    public static function makeFromGuzzleResponse(ResponseInterface $response)
    {
        $instance = new self();
        $instance->statusCode = $response->getStatusCode();
        $instance->statusText = $response->getReasonPhrase();
        $instance->headers = $response->getHeaders();
        $responseText = (string)$response->getBody();
        try {
            $instance->body = \GuzzleHttp\json_decode($responseText, true);
        } catch (\InvalidArgumentException $e) {
            $instance->body = $responseText;
        }
        return $instance;
    }


    public static function makeFromHttp(string $responseText)
    {
        $instance = new self();
        list($headersText, $bodyText) = preg_split('#\r\n\r\n#', $responseText, 2);
        $headerStrings = preg_split('#\r\n#', $headersText);
        $headers = [];
        $statusString = array_shift($headerStrings);
        preg_match('#^HTTP/\d.\d\s(\d{3})\s*(.*)$#', $statusString, $matches);
        $instance->statusCode = (int)$matches[1];
        $instance->statusText = (string)$matches[2];
        foreach ($headerStrings as $headerString) {
            list($key, $value) = preg_split('#:#', $headerString, 2);
            $key = trim($key);
            $value = trim($value);
            if (!isset($headers[$key])) {
                $headers[$key] = [];
            }
            $headers[$key][] = $value;
        }
        $instance->headers = $headers;
        $instance->body = json_decode($bodyText, true);
        return $instance;
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
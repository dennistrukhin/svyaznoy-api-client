<?php
namespace SvyaznoyApi\Tests\HTTP;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Http\Response;

class ResponseTest extends TestCase
{

    const RESPONSE_TEXT = <<<HERE
HTTP/1.1 200 OK\r\nServer: nginx/0.8.53\r\nDate: Thu, 05 Oct 2017 14:32:41 GMT\r\nContent-Type: application/json; charset=UTF-8\r\nTransfer-Encoding: chunked\r\nConnection: keep-alive\r\nKeep-Alive: timeout=300\r\nLink: <http://bit.sandbox.dev.svyaznoy.ru/webservices/api/v1/shops?page=2&per_page=10>; rel=next\r\nLink: <http://bit.sandbox.dev.svyaznoy.ru/webservices/api/v1/shops?page=459&per_page=10>; rel=last\r\nLink: <http://bit.sandbox.dev.svyaznoy.ru/webservices/api/v1/shops?page=1&per_page=10>; rel=first\r\n\r\n[{"id":11190202,"name":"XL"}]\r\n
HERE;

    public function testConstructor()
    {
        $response = Response::makeFromHttp(self::RESPONSE_TEXT);
        $this->assertTrue(
            $response->getStatusCode() == 200,
            'Expected status code = 200 and got ' . $response->getStatusCode()
        );
        $this->assertTrue(
            $response->getStatusText() == 'OK',
            'Expected status test = OK and got ' . $response->getStatusText()
        );
        $this->assertTrue(is_array($response->getBody()));
        $this->assertTrue(is_array($response->getHeader('Link')) && count($response->getHeader('Link')) == 3);
        $this->assertTrue(count($response->getHeaders()) === 7);
        $this->assertTrue(is_null($response->getHeader('adszxc')));
        $this->assertTrue($response->getHeaderItem('Server', 0) == 'nginx/0.8.53');
        $this->assertTrue(is_null($response->getHeaderItem('qweasd', 0)));
    }

}
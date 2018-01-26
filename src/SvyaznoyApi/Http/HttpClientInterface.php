<?php
namespace SvyaznoyApi\Http;

interface HttpClientInterface
{

    public function get($uri, ?Headers $headers = null, $params = []): Response;
    public function post($uri, ?Headers $headers = null, $params = [], string $body = ''): Response;

}
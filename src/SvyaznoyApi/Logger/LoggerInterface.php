<?php
namespace SvyaznoyApi\Logger;

use SvyaznoyApi\Http\Request;
use SvyaznoyApi\Http\Response;

interface LoggerInterface
{

    public function logEvent(string $level, string $message);
    public function logRequest(Request $request);
    public function logResponse(Response $response);
    public function logObject(string $message, $object);

}
<?php
namespace SvyaznoyApi\Tests\Logger;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Logger\FileLogger;

class FileLoggerTest extends TestCase
{

    const PATH_TO_FILE = '/tmp/svyaznoy_api_client_log.txt';

    public function testLogEvent()
    {
        if (file_exists(self::PATH_TO_FILE)) {
            unlink(self::PATH_TO_FILE);
        }
        $logger = new FileLogger(self::PATH_TO_FILE);
        $logger->logEvent('debug', 'test event');
        unset($logger);
        $str = file_get_contents(self::PATH_TO_FILE);
        $this->assertTrue(strpos($str, 'debug') !== false);
        $this->assertTrue(strpos($str, 'test event') !== false);
    }

}
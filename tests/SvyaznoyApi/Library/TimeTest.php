<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\Time;

class TimeTest extends TestCase
{

    const DEFAULT_HOUR = 12;
    const DEFAULT_MINUTE = 25;
    const DEFAULT_SECOND = 30;
    const FULL_TIME_STRING = self::DEFAULT_HOUR . ':' . self::DEFAULT_MINUTE . ':' . self::DEFAULT_SECOND;
    const FULL_TIME_STRING_UNTRIMMED = '   ' . self::DEFAULT_HOUR . '  :  ' . self::DEFAULT_MINUTE . '  :  ' . self::DEFAULT_SECOND . '   ';
    const SHORT_TIME_STRING = self::DEFAULT_HOUR . ':' . self::DEFAULT_MINUTE;

    public function testConstructorWithParams()
    {
        $time = new Time(self::DEFAULT_HOUR, self::DEFAULT_MINUTE, self::DEFAULT_SECOND);
        $this->assertTrue($time->getHour() === self::DEFAULT_HOUR, 'Hour was assigned incorrectly');
        $this->assertTrue($time->getMinute() === self::DEFAULT_MINUTE, 'Minute was assigned incorrectly');
        $this->assertTrue($time->getSecond() === self::DEFAULT_SECOND, 'Second was assigned incorrectly');
    }

    public function testMakeWithFullTimeString()
    {
        $time = Time::makeFromString(self::FULL_TIME_STRING);
        $this->assertTrue(
            $time->getHour() === self::DEFAULT_HOUR,
            'Hour was detected incorrectly, expected ' . self::DEFAULT_HOUR . ' and got ' . $time->getHour()
        );
        $this->assertTrue(
            $time->getMinute() === self::DEFAULT_MINUTE,
            'Minute was detected incorrectly, expected ' . self::DEFAULT_MINUTE . ' and got ' . $time->getMinute()
        );
        $this->assertTrue(
            $time->getSecond() === self::DEFAULT_SECOND,
            'Second was detected incorrectly, expected ' . self::DEFAULT_SECOND . ' and got ' . $time->getSecond()
        );
    }

    public function testMakeWithUntrimmedString()
    {
        $time = Time::makeFromString(self::FULL_TIME_STRING_UNTRIMMED);
        $this->assertTrue(
            $time->getHour() === self::DEFAULT_HOUR,
            'Untrimmed string: Hour was detected incorrectly, expected ' . self::DEFAULT_HOUR . ' and got ' . $time->getHour()
        );
        $this->assertTrue(
            $time->getMinute() === self::DEFAULT_MINUTE,
            'Untrimmed string: Minute was detected incorrectly, expected ' . self::DEFAULT_MINUTE . ' and got ' . $time->getMinute()
        );
        $this->assertTrue(
            $time->getSecond() === self::DEFAULT_SECOND,
            'Untrimmed string: Second was detected incorrectly, expected ' . self::DEFAULT_SECOND . ' and got ' . $time->getSecond()
        );
    }

    public function testMakeWithShortTimeString()
    {
        $time = Time::makeFromString(self::SHORT_TIME_STRING);
        $this->assertTrue(
            $time->getHour() === self::DEFAULT_HOUR,
            'Hour was detected incorrectly, expected ' . self::DEFAULT_HOUR . ' and got ' . $time->getHour()
        );
        $this->assertTrue(
            $time->getMinute() === self::DEFAULT_MINUTE,
            'Minute was detected incorrectly, expected ' . self::DEFAULT_MINUTE . ' and got ' . $time->getMinute()
        );
        $this->assertTrue(
            $time->getSecond() === 0,
            'Second was detected incorrectly, expected 0 and got ' . $time->getSecond()
        );
    }

    public function testFormat()
    {
        $time = new Time(12, 25, 30);
        $this->assertTrue(
            $time->format('H') === '12',
            'Wrong hour (H) formatting for two-digit values, expected 12 and got ' . $time->format('H')
        );
        $this->assertTrue(
            $time->format('i') === '25',
            'Wrong minute (i) formatting for two-digit values, expected 25 and got ' . $time->format('i')
        );
        $this->assertTrue(
            $time->format('s') === '30',
            'Wrong second (s) formatting for two-digit values, expected 30 and got ' . $time->format('s')
        );

        $time = new Time(1, 2, 3);
        $this->assertTrue(
            $time->format('H') === '01',
            'Wrong hour (H) formatting for one-digit values, expected 01 and got ' . $time->format('H')
        );
        $this->assertTrue(
            $time->format('i') === '02',
            'Wrong minute (i) formatting for one-digit values, expected 02 and got ' . $time->format('i')
        );
        $this->assertTrue(
            $time->format('s') === '03',
            'Wrong second (s) formatting for one-digit values, expected 03 and got ' . $time->format('s')
        );

        $time = new Time(1, 2, 3);
        $this->assertTrue(
            $time->format('H:i:s') === '01:02:03',
            'Wrong formatting for complex a format string, expected 01:02:03 and got ' . $time->format('H:i:s')
        );

        $time = new Time(1, 2, 3);
        $this->assertTrue(
            $time->format('\HH:\ii:\ss') === 'H01:i02:s03',
            'Wrong formatting with escape sequences, expected H01:i02:s03 and got ' . $time->format('\HH:\ii:\ss')
        );
    }

}
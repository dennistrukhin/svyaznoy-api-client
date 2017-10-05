<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\Time;
use SvyaznoyApi\Library\TimeInterval;

class TimeIntervalTest extends TestCase
{

    public function testMakeFromString()
    {
        $internal = TimeInterval::makeFromString('13:23 - 14:18');
        $this->assertTrue(
            $internal->getTimeFrom()->getHour() === 13 && $internal->getTimeFrom()->getMinute() === 23,
            'expected 13 hours and 23 minutes in TimeFrom and got ' . $internal->getTimeFrom()->getHour() . ' and ' . $internal->getTimeFrom()->getMinute()
        );
        $this->assertTrue(
            $internal->getTimeTo()->getHour() === 14 && $internal->getTimeTo()->getMinute() === 18,
            'expected 14 hours and 18 minutes in TimeFrom and got ' . $internal->getTimeTo()->getHour() . ' and ' . $internal->getTimeTo()->getMinute()
        );
    }

}
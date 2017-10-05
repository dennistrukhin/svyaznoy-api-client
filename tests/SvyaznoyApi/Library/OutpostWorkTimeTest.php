<?php
namespace SvyaznoyApi\Tests\Library;

use PHPUnit\Framework\TestCase;
use SvyaznoyApi\Library\OutpostWorkTime;
use SvyaznoyApi\Library\Time;
use SvyaznoyApi\Library\TimeInterval;

class OutpostWorkTimeTest extends TestCase
{

    public function testString()
    {
        $wt = new OutpostWorkTime();
        $wt->setString('123');
        $this->assertTrue($wt->getString() === '123');
    }

    public function testDayInterval()
    {
        $interval = new TimeInterval(new Time(1, 2), new Time(3, 4));
        $wt = new OutpostWorkTime();
        $this->assertTrue($wt->worksOn(1) === false);
        $wt->setDay(1, $interval);
        $this->assertTrue($wt->worksOn(1) === true);
        $this->assertTrue($wt->getForDay(1) === $interval);
    }

}
<?php

namespace Omalizadeh\JalaliCalendar\Tests;

use Omalizadeh\JalaliCalendar\JalaliCalendar;

class JalaliDatePeriodTest extends TestCase
{
    public function testPeriod(): void
    {
        $fromDate = '2022-03-03';
        $toDate = '2022-03-04';

        [$firstJalaliDate, $secondJalaliDate] = JalaliCalendar::checkPeriod($fromDate, $toDate);

        $this->assertFalse($firstJalaliDate->isHoliday());
        $this->assertEquals('1400/12/12', $firstJalaliDate->date());

        $this->assertTrue($secondJalaliDate->isHoliday());
        $this->assertEquals('1400/12/13', $secondJalaliDate->date());
    }
}

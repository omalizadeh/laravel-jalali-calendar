<?php

namespace Omalizadeh\JalaliCalendar\Tests;

use Omalizadeh\JalaliCalendar\JalaliCalendar;

class JalaliDatePeriodTest extends TestCase
{
    public function testPeriod(): void
    {
        $fromDate = '2022-03-03';
        $toDate = '2022-03-04';

        [$firstJalaliDate, $secondJalaliDate] = JalaliCalendar::fromGregorianPeriod($fromDate, $toDate);

        $this->assertFalse($firstJalaliDate->isHoliday());
        $this->assertEquals('1400/12/12', $firstJalaliDate->format());

        $this->assertTrue($secondJalaliDate->isHoliday());
        $this->assertEquals('1400/12/13', $secondJalaliDate->format());
    }
}

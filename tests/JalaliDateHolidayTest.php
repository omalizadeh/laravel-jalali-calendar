<?php

namespace Omalizadeh\JalaliCalendar\Tests;

use Omalizadeh\JalaliCalendar\JalaliCalendar;

class JalaliDateHolidayTest extends TestCase
{
    public function testRandomFridayIsDeterminedHoliday(): void
    {
        $date = '2022-02-04';

        $jalaliDate = JalaliCalendar::check($date);

        $this->assertTrue($jalaliDate->isHoliday());
        $this->assertEquals('1400-11-15', $jalaliDate->date());
    }

    public function testRandomWorkingMondayIsNotDeterminedAsHoliday(): void
    {
        $date = '2022-02-07';

        $jalaliDate = JalaliCalendar::check($date);

        $this->assertFalse($jalaliDate->isHoliday());
        $this->assertEquals('1400/11/18', $jalaliDate->date('Y/m/d'));
    }
}

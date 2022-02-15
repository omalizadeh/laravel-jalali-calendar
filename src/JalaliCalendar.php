<?php

namespace Omalizadeh\JalaliCalendar;

class JalaliCalendar
{
    public static function check(string $date): JalaliDate
    {
        return (new JalaliDateEventsCrawler($date))->getEvents();
    }
}

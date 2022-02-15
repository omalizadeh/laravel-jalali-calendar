<?php

namespace Omalizadeh\JalaliCalendar;

use Illuminate\Support\Facades\Facade;

class JalaliCalendar extends Facade
{
    public static function getEvents(string $date): JalaliDate
    {
        return (new JalaliDateEventsCrawler($date))->getEvents();
    }
}

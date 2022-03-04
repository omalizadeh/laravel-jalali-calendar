<?php

namespace Omalizadeh\JalaliCalendar;

use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class JalaliCalendar
{
    public static function check(string $date): JalaliDate
    {
        return (new JalaliDateEventsCrawler($date))->getEvents();
    }

    public static function checkPeriod(string $fromDate, string $toDate): Collection
    {
        $datePeriod = CarbonPeriod::create($fromDate, $toDate);

        $jalaliDates = collect();

        foreach ($datePeriod as $date) {
            $jalaliDates->add((new JalaliDateEventsCrawler($date))->getEvents());
        }

        return $jalaliDates;
    }
}

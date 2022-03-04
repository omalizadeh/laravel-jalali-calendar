<?php

namespace Omalizadeh\JalaliCalendar;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;

class JalaliDate implements Arrayable, Responsable
{
    protected string $unixTimestamp;
    protected bool $isHoliday;
    protected array $events;

    public function __construct(string $unixTimestamp, bool $isHoliday, array $events)
    {
        $this->unixTimestamp = $unixTimestamp;
        $this->isHoliday = $isHoliday;
        $this->events = $events;
    }

    public function date(string $format = 'Y/m/d'): string
    {
        return jdate($this->unixTimestamp)->format($format);
    }

    public function isHoliday(): bool
    {
        return $this->isHoliday;
    }

    public function events(): array
    {
        return $this->events;
    }

    public function toArray(): array
    {
        return [
            'is_holiday' => $this->isHoliday,
            'events' => $this->events,
        ];
    }

    public function toResponse($request)
    {
        return response()->json([
            'data' => $this->toArray()
        ]);
    }
}

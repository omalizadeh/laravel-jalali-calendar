<?php

namespace Omalizadeh\JalaliCalendar;

use DOMDocument;
use DomXPath;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;

class JalaliDateEventsCrawler
{
    protected int $unixTimestamp;
    protected string $htmlBody;

    public function __construct(string $date)
    {
        $this->unixTimestamp = strtotime($date);
    }

    public function getEvents(): JalaliDate
    {
        $this->crawl();

        return $this->parse();
    }

    protected function crawl(): void
    {
        [$year, $month, $day] = CalendarUtils::toJalali(
            date("Y", $this->unixTimestamp),
            date("m", $this->unixTimestamp),
            date("d", $this->unixTimestamp)
        );

        $url = "https://time.ir/fa/event/list/0/$year/$month/$day";

        $response = Http::withOptions([
            'verify' => false
        ])->get($url);

        $this->htmlBody = $response->body();
    }

    protected function parse(): JalaliDate
    {
        libxml_use_internal_errors(true);

        $doc = new DomDocument();
        $doc->loadHTML('<?xml encoding="UTF-8">'.$this->htmlBody);
        $doc->preserveWhiteSpace = false;

        $xpath = new DomXPath($doc);
        $elements = $xpath->query("//*[@class='list-unstyled']//li");

        $isHoliday = false;
        $events = [];

        if ((int) date('w', $this->unixTimestamp) === 5) {
            $isHoliday = true;
            $events[] = [
                'description' => 'جمعه',
                'additional_description' => '',
                'is_religious' => false
            ];
        }

        foreach ($elements as $element) {
            $children = $element->getElementsByTagName('span');
            $dateString = $children->item(0)->nodeValue;
            $additionalDescription = $children->item(1)->nodeValue;
            $description = str_replace(array($additionalDescription, $dateString), "", $element->nodeValue);

            if (!$isHoliday) {
                $isHoliday = $element->hasAttribute('class')
                    && Str::contains($element->getAttribute('class'), 'eventHoliday');
            }

            $events[] = [
                'description' => trim($description),
                'additional_description' => trim(preg_replace("/\[|\]/", "", $additionalDescription)),
                'is_religious' => (
                    trim($children->item(1)->nodeValue) != ""
                    && $children->item(1)->getElementsByTagName('span')->length == 0
                    && !preg_match('/(.*)[a-z]+(.*)/', trim($children->item(1)->nodeValue))
                )
            ];
        }

        return new JalaliDate($this->unixTimestamp, $isHoliday, $events);
    }
}

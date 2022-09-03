[![License](http://poser.pugx.org/omalizadeh/laravel-jalali-calendar/license)](https://packagist.org/packages/omalizadeh/laravel-jalali-calendar)
[![Tests](https://github.com/omalizadeh/laravel-jalali-calendar/actions/workflows/tests.yml/badge.svg)](https://github.com/omalizadeh/laravel-jalali-calendar/actions/workflows/tests.yml)
[![Latest Stable Version](http://poser.pugx.org/omalizadeh/laravel-jalali-calendar/v)](https://packagist.org/packages/omalizadeh/laravel-jalali-calendar)
[![Total Downloads](http://poser.pugx.org/omalizadeh/laravel-jalali-calendar/downloads)](https://packagist.org/packages/omalizadeh/laravel-jalali-calendar)

# Laravel Jalali Calendar

This is a laravel package to get jalali date events and holidays by parsing time.ir website.

## Installation

Install package with composer:

```bash
composer require omalizadeh/laravel-jalali-calendar
```

## Usage

Get a `JalaliDate` object by calling `fromGregorian` static method on `JalaliCalendar` class. example:

```php
    use Omalizadeh\JalaliCalendar\JalaliCalendar;

    $jalaliDate = JalaliCalendar::fromGregorian('2020-05-24');
```

Or you can get a collection of `JalaliDate` objects by giving a gregorian period.

```php
    use Omalizadeh\JalaliCalendar\JalaliCalendar;

    $jalaliDates = JalaliCalendar::fromGregorianPeriod('2020-05-24', '2020-05-28');
```

Then you can get different info from `JalaliDate` object. supported methods:

| Methods   | Return type   | Description      |
| --------- | ------------- | ---------------------|
| format() | string        | Jalali date with given format|
| isHoliday() | bool        | Check jalali date is holiday|
| events() | array        | Get date's events|

## License

- Laravel Jalali Calendar is open-sourced software licensed under the [MIT license](LICENSE).
- This package is created based on [Persiancalapi](https://github.com/hpez/persiancalapi) project.

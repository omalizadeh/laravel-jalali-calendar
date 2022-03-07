# Laravel Jalali Calendar

This is a laravel package to get jalali date events and holidays by parsing time.ir website.

## Installation

Install package with composer:

```bash
composer require omalizadeh/laravel-jalali-calendar
```

## Usage

Get a `JalaliDate` object by calling `check` static method on `JalaliCalendar` class. example:

```php
    use Omalizadeh\JalaliCalendar\JalaliCalendar;

    $jalaliDate = JalaliCalendar::fromGregorian('2020-05-24');
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

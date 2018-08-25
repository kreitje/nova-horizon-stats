# Nova Horizon Stats
For sites that use Laravel Horizon, this provides a few cards to show stats you will find on /horizon. 

## Installation

You can install the package in to a Laravel app that uses Nova via composer:
```
composer require kreitje/nova-horizon-stats
```

## Usage:
```php
public function cards() {
    return [
        new JobsPastHour,
        new FailedJobsPastHour,
    ];
}
```

You can pass an argument into the classes for how many seconds to automatically refresh. It defaults to the 30 seconds.

```php
public function cards() {
    return [
        new JobsPastHour(5),
        new FailedJobsPastHour(10),
    ];
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
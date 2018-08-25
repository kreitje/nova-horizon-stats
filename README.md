# Nova Horizon Stats
For sites that use Laravel Horizon, this provides a few cards to show stats you will find on /horizon. 

## Installation

You can install the package in to a Laravel app that uses Nova via composer:
```
composer require kreitje/nova-horizon-stats
```

In your `app/Providers/NovaServiceProvider.php` add the cards to the cards method array.

## Usage:
```php
public function cards() {
    return [
        new \Kreitje\NovaHorizonStats\JobsPastHour,
        new \Kreitje\NovaHorizonStats\FailedJobsPastHour,
        new \Kreitje\NovaHorizonStats\Processes
    ];
}
```

You can pass an argument into the classes for how many seconds to automatically refresh. It defaults to the 30 seconds.

```php
public function cards() {
    return [
        new \Kreitje\NovaHorizonStats\JobsPastHour(5),
        new \Kreitje\NovaHorizonStats\FailedJobsPastHour(10),
        new \Kreitje\NovaHorizonStats\Processes(15)
    ];
}
```

If you want to change the title of the cards, pass a second argument to the card classes.
```php
public function cards() {
    return [
        new \Kreitje\NovaHorizonStats\JobsPastHour(5, 'Jobs from the past hour')
    ];
}
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
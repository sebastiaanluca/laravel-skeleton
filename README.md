# Laravel Skeleton

**An opinionated fresh Laravel project to help you get started.**

## Notes

## Redis

This project uses PhpRedis which is 6x faster than the previously default Predis, but it does require you to install the PECL package first (see https://github.com/phpredis/phpredis).

### Horizon

Be sure to check `\Modules\Horizon\Providers\HorizonServiceProvider` and update the `viewHorizon` auth gate to determine can or cannot view Horizon in production.

### Telescope

Be sure to check `\Modules\Telescope\Providers\TelescopeServiceProvider` and update the `viewTelescope` auth gate to determine can or cannot view Telescope in production.

### Timezones

All dates and times are stored and returned in the UTC timezone.

If you need to store a date/time inputted by the user:

```php
$model->published_at = Carbon::fromDisplayTimezone($request->published_at);
```

If you need to return a localized date/time:

```php
$model->created_at->toDisplayTimezone()->formatLocalized('%A %B %H');
```

# Laravel Skeleton

**An opinionated fresh Laravel project to help you get started.**

## Notes

### Timezones

All dates and times are stored and returned in the UTC timezone.

If you need to store a date/time inputted by the user:

```php
$model->published_at = Carbon::fromLocalTimezone($request->published_at);
```


If you need to return a localized date/time:

```php
$model->created_at->toLocalTimezone()->formatLocalized('%B');
```

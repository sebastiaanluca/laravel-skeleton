<?php

declare(strict_types=1);

namespace Modules\DateTime;

use Illuminate\Support\Facades\Auth;

class DateTimeManager
{
    public static function autoSetDisplayTimezone() : void
    {
        $timezone = static::determineDisplayTimezone();

        static::setDisplayTimezone($timezone);
    }

    public static function setDisplayTimezone(string $timezone) : void
    {
        $timezone = static::getSupportedDisplayTimezone($timezone);

        config()->set('app.display_timezone', $timezone);
    }

    public static function setSessionDisplayTimezone(string $timezone) : void
    {
        $timezone = static::getSupportedDisplayTimezone($timezone);

        session()->put('app.display_timezone', $timezone);
    }

    public static function getSupportedDisplayTimezone(string $timezone) : string
    {
        if (validate($timezone, 'timezone')) {
            return $timezone;
        }

        return config('app.display_timezone');
    }

    private static function determineDisplayTimezone() : string
    {
        if ($user = Auth::user()) {
            return $user->timezone;
        }

        if ($timezone = session()->get('app.display_timezone')) {
            return $timezone;
        }

        return config('app.display_timezone');
    }
}

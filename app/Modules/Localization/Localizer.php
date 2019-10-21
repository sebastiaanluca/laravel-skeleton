<?php

declare(strict_types=1);

namespace Modules\Localization;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Localization\Enums\Locales;

class Localizer
{
    /**
     * Automatically determine and set the application locale.
     */
    public static function autoSetLocale() : void
    {
        $locale = static::determineLocale();

        static::setLocale($locale);
    }

    /**
     * @param string $locale
     */
    public static function setLocale(string $locale) : void
    {
        $locale = static::getSupportedLocale($locale);

        app()->setLocale($locale);

        setlocale(LC_TIME, $locale, $locale);

        Carbon::setLocale($locale);
    }

    /**
     * @param string $locale
     */
    public static function setSessionLocale(string $locale) : void
    {
        $locale = static::getSupportedLocale($locale);

        session()->put('app.locale', $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public static function getSupportedLocale(string $locale) : string
    {
        if (! in_array($locale, Locales::values(), true)) {
            return config('app.fallback_locale');
        }

        return $locale;
    }

    /**
     * @return string
     */
    private static function determineLocale() : string
    {
        if ($user = Auth::user()) {
            return $user->locale;
        }

        if ($locale = session()->get('app.locale')) {
            return $locale;
        }

        return config('app.fallback_locale');
    }
}

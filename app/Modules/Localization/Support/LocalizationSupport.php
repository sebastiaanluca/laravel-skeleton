<?php

declare(strict_types=1);

namespace Modules\Localization\Support;

class LocalizationSupport
{
    /**
     * Simplify the given locale.
     *
     * @param string $locale
     *
     * @return string
     */
    public static function simplifyLocale(string $locale) : string
    {
        return mb_strtolower(str_before($locale, '_'));
    }
}

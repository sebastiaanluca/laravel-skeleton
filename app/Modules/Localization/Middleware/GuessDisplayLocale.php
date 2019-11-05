<?php

declare(strict_types=1);

namespace Modules\Localization\Middleware;

use Closure;
use Locale;
use Modules\Localization\LocalizationManager;
use Modules\Localization\Support\LocalizationSupport;

class GuessDisplayLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (LocalizationManager::hasSessionLocale()) {
            return $next($request);
        }

        $locale = Locale::acceptFromHttp(
            $request->server('HTTP_ACCEPT_LANGUAGE')
        );

        LocalizationManager::setSessionLocale(
            LocalizationSupport::simplifyLocale($locale)
        );

        return $next($request);
    }
}

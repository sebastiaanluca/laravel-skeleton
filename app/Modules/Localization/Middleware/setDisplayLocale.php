<?php

namespace App\Http\Middleware;

namespace Modules\Localization\Middleware;

use Closure;
use Modules\Localization\LocaleManager;

class setDisplayLocale
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
        LocaleManager::autoSetLocale();

        return $next($request);
    }
}

<?php

namespace Modules\Localization\Middleware;

use Closure;
use Modules\Localization\LocalizationManager;

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
        LocalizationManager::autoSetLocale();

        return $next($request);
    }
}

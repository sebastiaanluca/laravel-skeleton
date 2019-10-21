<?php

namespace App\Http\Middleware;

namespace Modules\Localization\Middleware;

use Closure;
use Modules\Localization\Localizer;

class Localize
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
        Localizer::autoSetLocale();

        return $next($request);
    }
}

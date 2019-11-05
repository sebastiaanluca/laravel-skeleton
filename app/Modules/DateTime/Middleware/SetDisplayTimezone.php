<?php

declare(strict_types=1);

namespace Modules\DateTime\Middleware;

use Closure;
use Modules\DateTime\DateTimeManager;

class SetDisplayTimezone
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
        DateTimeManager::autoSetDisplayTimezone();

        return $next($request);
    }
}

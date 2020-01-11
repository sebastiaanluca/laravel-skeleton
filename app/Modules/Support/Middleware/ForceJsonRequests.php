<?php

declare(strict_types=1);

namespace Modules\Support\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * To force JSON communication, put middleware before any other middleware that
 * interact with the request's `wantsJson` or `expectsJson` methods.
 */
class ForceJsonRequests
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Content-type', 'application/json');
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}

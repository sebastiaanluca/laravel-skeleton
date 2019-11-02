<?php

declare(strict_types=1);

namespace Modules\Support\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}

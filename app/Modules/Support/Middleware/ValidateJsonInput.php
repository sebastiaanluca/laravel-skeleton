<?php

declare(strict_types=1);

namespace Modules\Support\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateJsonInput
{
    /**
     * Validate the JSON request's body parameters if there are any.
     *
     * @source https://github.com/guzzle/guzzle/blob/master/src/functions.php#L300
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isJson() && $request->request->count() !== 0) {
            json_decode($request->getContent(), $associative = false, 512, JSON_THROW_ON_ERROR);
        }

        return $next($request);
    }
}

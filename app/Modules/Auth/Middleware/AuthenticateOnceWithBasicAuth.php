<?php

declare(strict_types=1);

namespace Modules\Auth\Middleware;

use Auth;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Require the user to authenticate once using basic auth credentials.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        return Auth::onceBasic() ?? $next($request);
    }
}

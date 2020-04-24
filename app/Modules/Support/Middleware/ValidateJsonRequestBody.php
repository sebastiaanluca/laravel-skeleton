<?php

declare(strict_types=1);

namespace Modules\Support\Middleware;

use Closure;
use Illuminate\Http\Request;
use JsonException;
use Modules\Support\Exceptions\MalformedJsonRequest;

class ValidateJsonRequestBody
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
     *
     * @throws \Modules\Support\Exceptions\MalformedJsonRequest
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isJson() && $this->requestHasContent($request)) {
            try {
                json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $exception) {
                throw MalformedJsonRequest::unableToParse();
            }
        }

        return $next($request);
    }

    private function requestHasContent(Request $request) : bool
    {
        return trim($request->getContent()) !== '';
    }
}

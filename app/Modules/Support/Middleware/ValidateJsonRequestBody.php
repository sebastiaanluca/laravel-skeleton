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
        if ($this->isJsonRequest($request) && $this->requestHasContent($request)) {
            try {
                json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $exception) {
                throw MalformedJsonRequest::unableToParse();
            }
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    private function isJsonRequest(Request $request) : bool
    {
        return $request->isJson() || $request->wantsJson();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    private function requestHasContent(Request $request) : bool
    {
        return trim($request->getContent()) !== '';
    }
}

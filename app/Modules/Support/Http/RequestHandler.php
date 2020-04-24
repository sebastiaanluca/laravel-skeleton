<?php

declare(strict_types=1);

namespace Modules\Support\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;

class RequestHandler extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests, DispatchesJobs;

    /**
     * Executed when the object itself is called as a method.
     *
     * Pass the call on to a handle method for improved readability.
     *
     * @param array ...$arguments
     *
     * @return mixed
     */
    public function __invoke(...$arguments)
    {
        $trace = last(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2));
        $parameters = Arr::get($trace, 'args.1');

        return $this->handleRequest($parameters);
    }

    /**
     * Handle the request.
     *
     * @param array $arguments
     *
     * @return mixed
     */
    private function handleRequest($arguments)
    {
        if (method_exists($this, 'authorize')) {
            $response = app()->call([$this, 'authorize'], $arguments);
        }

        if (isset($response) && $response !== null) {
            return $response;
        }

        return app()->call([$this, 'handle'], $arguments);
    }
}

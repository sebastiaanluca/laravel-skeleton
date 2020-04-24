<?php

declare(strict_types=1);

namespace Modules\Api\Concerns;

use Closure;
use Illuminate\Support\Arr;
use Modules\Api\Entities\ApiResponse;
use Modules\Api\Entities\MultiApiResponse;
use Modules\Api\Exceptions\PaginatedRequestFailed;

trait MakesPaginatedRequests
{
    private int $upperPageLimit = 10;

    protected function requestAllPages(Closure $request) : array
    {
        $page = 1;

        $jointResponse = new MultiApiResponse;

        do {
            $response = $request(compact('page'));

            $jointResponse->addResponse($response);

            ++$page;
        } while ($this->hasMoreResults($response) && $this->shouldQueryForMoreResults($response));

        if ($this->hasMoreResults($response)) {
            throw PaginatedRequestFailed::upperPageLimitReached($response, $this->upperPageLimit);
        }

        return $jointResponse->data();
    }

    private function hasMoreResults(ApiResponse $response) : bool
    {
        return Arr::get($response->toArray(), 'next_page') !== null;
    }

    private function shouldQueryForMoreResults(ApiResponse $response) : bool
    {
        return Arr::get($response->toArray(), 'page', 1) <= $this->upperPageLimit;
    }
}

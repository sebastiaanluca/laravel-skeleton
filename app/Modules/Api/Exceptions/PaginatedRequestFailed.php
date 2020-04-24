<?php

declare(strict_types=1);

namespace Modules\Api\Exceptions;

use Modules\Api\Entities\ApiResponse;

class PaginatedRequestFailed extends ApiException
{
    public static function upperPageLimitReached(ApiResponse $response, int $limit) : PaginatedRequestFailed
    {
        $body = $response->toArray();

        return new static(sprintf(
            'Fetched up to page %s of %s and then failed because it reached the upper page limit of %s.',
            $limit,
            array_get($body, 'page', 1),
            array_get($body, 'next_page')
        ));
    }
}

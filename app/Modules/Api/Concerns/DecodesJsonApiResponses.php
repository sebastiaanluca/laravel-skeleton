<?php

declare(strict_types=1);

namespace Modules\Api\Concerns;

use Illuminate\Support\Collection;
use Modules\Api\Entities\ApiResponse;
use Psr\Http\Message\ResponseInterface;

trait DecodesJsonApiResponses
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Modules\Api\Entities\ApiResponse
     */
    protected function decodeJsonResponseToApiResponse(ResponseInterface $response) : ApiResponse
    {
        return new ApiResponse($this->decodeJsonResponse($response));
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function decodeJsonResponse(ResponseInterface $response) : array
    {
        return json_decode(
            $response->getBody()->getContents(),
            $associative = true,
            512,
            JSON_THROW_ON_ERROR
        );
    }

    /**
     * @param \Illuminate\Support\Collection $responses
     *
     * @return \Illuminate\Support\Collection
     */
    protected function decodeResponsesToJson(Collection $responses) : Collection
    {
        return $responses->map(function (ResponseInterface $response) {
            return json_decode(
                $response->getBody()->getContents(),
                $associative = true,
                512,
                JSON_THROW_ON_ERROR
            );
        });
    }
}

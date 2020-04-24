<?php

declare(strict_types=1);

namespace Modules\Api\Entities;

class MultiApiResponse
{
    private array $responses;

    public function __construct(array $responses = [])
    {
        $this->responses = $responses;
    }

    public function addResponse(ApiResponse $response) : self
    {
        $this->responses[] = $response;

        return $this;
    }

    public function responses() : array
    {
        return $this->responses;
    }

    public function data() : array
    {
        return collect($this->responses())
            ->flatMap->data()
            ->toArray();
    }
}

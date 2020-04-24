<?php

declare(strict_types=1);

namespace Modules\Api\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class ApiResponse implements Arrayable, Jsonable
{
    private array $response;
    private string $dataKey = 'data';

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function toArray() : array
    {
        return $this->response;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0) : string
    {
        return json_encode(
            $this->toArray(),
            array_merge([JSON_THROW_ON_ERROR], $options)
        );
    }

    public function data() : array
    {
        return array_get(
            $this->toArray(),
            $this->dataKey
        );
    }

    public function setDataKey(string $key) : self
    {
        $this->dataKey = $key;

        return $this;
    }
}

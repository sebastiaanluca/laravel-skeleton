<?php

declare(strict_types=1);

namespace Modules\Api\Entities;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;

class JsonApiRequest extends ApiRequest
{
    public function __construct(string $method, string $endpoint, array $body = [], array $options = [])
    {
        $options[RequestOptions::HEADERS] = array_merge_recursive(
            ['Content-Type' => 'application/json'],
            Arr::get($options, RequestOptions::HEADERS, [])
        );

        $options[RequestOptions::JSON] = array_merge_recursive(
            $body,
            Arr::get($options, RequestOptions::JSON, [])
        );

        parent::__construct($method, $endpoint, $options);
    }

    public function getJson() : array
    {
        return Arr::get($this->options, RequestOptions::JSON, []);
    }

    public function setJson(array $json) : JsonApiRequest
    {
        Arr::get($this->options, RequestOptions::JSON, $json);

        return $this;
    }
}

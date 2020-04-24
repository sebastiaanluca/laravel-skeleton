<?php

declare(strict_types=1);

namespace Modules\Api\Entities;

use GuzzleHttp\RequestOptions;

class FormApiRequest extends ApiRequest
{
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $body
     * @param array $options
     */
    public function __construct(string $method, string $endpoint, array $body = [], array $options = [])
    {
        $options[RequestOptions::HEADERS] = array_merge_recursive(
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            array_get($options, RequestOptions::HEADERS, [])
        );

        $options[RequestOptions::FORM_PARAMS] = array_merge_recursive(
            $body,
            array_get($options, RequestOptions::FORM_PARAMS, [])
        );

        parent::__construct($method, $endpoint, $options);
    }

    /**
     * @return array
     */
    public function getParameters() : array
    {
        return array_get($this->options, RequestOptions::FORM_PARAMS, []);
    }

    /**
     * @param array $parameters
     *
     * @return \Modules\Api\Entities\FormApiRequest
     */
    public function setParameters(array $parameters) : FormApiRequest
    {
        array_set($this->options, RequestOptions::FORM_PARAMS, $parameters);

        return $this;
    }
}

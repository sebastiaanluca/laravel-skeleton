<?php

declare(strict_types=1);

namespace Modules\Api\Entities;

class ApiRequest
{
    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $endpoint;

    /**
     * @var array
     */
    public $options;

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $options
     */
    public function __construct(string $method, string $endpoint, array $options = [])
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return \Modules\Api\Entities\ApiRequest
     */
    public function setMethod(string $method) : ApiRequest
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return \Modules\Api\Entities\ApiRequest
     */
    public function setEndpoint(string $endpoint) : ApiRequest
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return \Modules\Api\Entities\ApiRequest
     */
    public function setOptions(array $options) : ApiRequest
    {
        $this->options = $options;

        return $this;
    }
}

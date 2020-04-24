<?php

declare(strict_types=1);

namespace Modules\Api\Exceptions;

use RuntimeException;

class ApiException extends RuntimeException
{
    /**
     * @param string $error
     *
     * @return \Modules\Api\Exceptions\ApiException
     */
    public static function body(string $error) : ApiException
    {
        return new static("The API request failed with a body error: $error");
    }

    /**
     * @param string $message
     *
     * @return \Modules\Api\Exceptions\ApiException
     */
    public static function unauthorized(string $message = '') : ApiException
    {
        return new static(sprintf('The API request is lacking proper authentication (%s).', $message));
    }

    /**
     * @param int|null $statusCode
     * @param string|null $message
     * @param int|null $code
     *
     * @return \Modules\Api\Exceptions\ApiException
     */
    public static function requestFailed(?int $statusCode = null, ?string $message = null, ?int $code = null) : ApiException
    {
        $statusCode = $statusCode ?? 'unknown';

        $context = [];

        if ($code) {
            $context[] = "Code: $code";
        }

        if ($message) {
            $context[] = "Message: $message";
        }

        return new static(sprintf("The API request returned a $statusCode HTTP status code (%s)", implode(' ', $context)));
    }
}

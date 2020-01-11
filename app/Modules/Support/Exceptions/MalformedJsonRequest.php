<?php

declare(strict_types=1);

namespace Modules\Support\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class MalformedJsonRequest extends HttpException
{
    /**
     * @return static
     */
    public static function unableToParse() : self
    {
        return new static(400, 'Unable to parse request: invalid JSON encountered. Please check your request\'s body parameters.');
    }
}

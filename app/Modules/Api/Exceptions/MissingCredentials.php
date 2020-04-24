<?php

declare(strict_types=1);

namespace Modules\Api\Exceptions;

class MissingCredentials extends ApiException
{
    /**
     * @param string $field
     *
     * @return \Modules\Api\Exceptions\MissingCredentials
     */
    public static function missingValue(string $field) : MissingCredentials
    {
        return new static(sprintf('The %s has not been set.', $field));
    }
}

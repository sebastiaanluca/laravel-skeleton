<?php

declare(strict_types=1);

namespace Modules\Api\Entities\Grants;

interface AuthenticationGrant extends Grant
{
    /**
     * @return array
     */
    public function getRequestBody() : array;
}

<?php

declare(strict_types=1);

namespace Modules\Api\Services;

use Modules\Api\Entities\Grants\PersonalAccessToken;

trait AuthenticatesWithPersonalAccessToken
{
    /**
     * @return \Modules\Api\Entities\Grants\PersonalAccessToken
     */
    protected function personalAccessToken() : PersonalAccessToken
    {
        return $this->credentials;
    }
}

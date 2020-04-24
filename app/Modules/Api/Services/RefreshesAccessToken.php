<?php

declare(strict_types=1);

namespace Modules\Api\Services;

use Modules\Api\Entities\Grants\Grant;

trait RefreshesAccessToken
{
    /**
     * @var \Modules\Api\Services\ApiAuthenticator
     */
    private $authenticator;

    /**
     * @param string $baseUri
     * @param \Modules\Api\Entities\Grants\Grant $credentials
     * @param string $cachePrefix
     *
     * @return \Modules\Api\Services\ApiAuthenticator
     */
    protected function configureAuthenticator(string $baseUri, Grant $credentials, string $cachePrefix) : ApiAuthenticator
    {
        $this->authenticator = new ApiAuthenticator(
            $baseUri,
            $credentials,
            $cachePrefix
        );

        return $this->authenticator;
    }

    /**
     * @return \Modules\Api\Services\ApiAuthenticator
     */
    protected function authenticator() : ApiAuthenticator
    {
        return $this->authenticator;
    }
}

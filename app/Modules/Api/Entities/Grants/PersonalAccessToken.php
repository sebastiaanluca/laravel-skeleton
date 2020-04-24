<?php

declare(strict_types=1);

namespace Modules\Api\Entities\Grants;

use Modules\Api\Exceptions\MissingCredentials;

class PersonalAccessToken implements Grant
{
    /**
     * @var string
     */
    private $accountId;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @param string $accountId
     * @param string $accessToken
     */
    public function __construct(string $accountId, string $accessToken)
    {
        $this->accountId = $accountId;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function grantType() : string
    {
        return 'personal_access_token';
    }

    /**
     * @return string
     *
     * @throws \Modules\Api\Exceptions\MissingCredentials
     */
    public function getAccountId() : string
    {
        if (empty($this->accountId)) {
            throw MissingCredentials::missingValue('account ID');
        }

        return $this->accountId;
    }

    /**
     * @return string
     *
     * @throws \Modules\Api\Exceptions\MissingCredentials
     */
    public function getAccessToken() : string
    {
        if (empty($this->accessToken)) {
            throw MissingCredentials::missingValue('access token');
        }

        return $this->accessToken;
    }
}

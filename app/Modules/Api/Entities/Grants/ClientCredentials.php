<?php

declare(strict_types=1);

namespace Modules\Api\Entities\Grants;

use Modules\Api\Exceptions\MissingCredentials;

class ClientCredentials implements Grant
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return array
     */
    public function getRequestBody() : array
    {
        return [
            'grant_type' => $this->grantType(),
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
        ];
    }

    /**
     * @return string
     */
    public function grantType() : string
    {
        return 'client_credentials';
    }

    /**
     * @return string
     *
     * @throws \Modules\Api\Exceptions\MissingCredentials
     */
    public function getClientId() : string
    {
        if (empty($this->clientId)) {
            throw MissingCredentials::missingValue('client ID');
        }

        return $this->clientId;
    }

    /**
     * @return string
     *
     * @throws \Modules\Api\Exceptions\MissingCredentials
     */
    public function getClientSecret() : string
    {
        if (empty($this->clientSecret)) {
            throw MissingCredentials::missingValue('client secret');
        }

        return $this->clientSecret;
    }
}

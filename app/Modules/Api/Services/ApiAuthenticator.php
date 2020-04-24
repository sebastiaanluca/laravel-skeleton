<?php

declare(strict_types=1);

namespace Modules\Api\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Modules\Api\Concerns\DecodesJsonApiResponses;
use Modules\Api\Entities\ApiResponse;
use Modules\Api\Entities\Grants\Grant;
use Modules\Api\Entities\JsonApiRequest;
use Psr\Http\Message\ResponseInterface;

class ApiAuthenticator
{
    use DecodesJsonApiResponses;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var \Modules\Api\Entities\Grants\Grant
     */
    private $credentials;

    /**
     * @var string
     */
    private $cachePrefix;

    /**
     * @param string $baseUri
     * @param \Modules\Api\Entities\Grants\Grant $credentials
     * @param string $cachePrefix
     */
    public function __construct(string $baseUri, Grant $credentials, string $cachePrefix)
    {
        $this->baseUri = $baseUri;
        $this->credentials = $credentials;
        $this->cachePrefix = $cachePrefix;
    }

    /**
     * @return string
     */
    public function getOrRefreshAccessToken() : string
    {
        if (! $token = cache()->get($this->cachePrefix . '.token')) {
            $token = $this->refreshAccessToken();
        }

        return $token['access_token'];
    }

    /**
     * @return array
     */
    public function refreshAccessToken() : array
    {
        $response = $this->authenticate()->toArray();

        cache()->put(
            $this->cachePrefix . '.token',
            $response,
            now()->addSeconds(Arr::get($response, 'expires_in', 3600))
        );

        return $response;
    }

    /**
     * @return \Modules\Api\Entities\ApiResponse
     */
    public function authenticate() : ApiResponse
    {
        $request = new JsonApiRequest(
            'POST',
            'oauth/token',
            array_merge($this->credentials->getRequestBody(), ['scope' => '*']),
            $this->options()
        );

        $response = $this->request($request);

        return $this->decodeJsonResponseToApiResponse($response);
    }

    /**
     * @param \Modules\Api\Entities\JsonApiRequest $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function request(JsonApiRequest $request) : ResponseInterface
    {
        return (new Client)->request(
            $request->getMethod(),
            $request->getEndpoint(),
            $request->getOptions()
        );
    }

    /**
     * @return array
     */
    private function options() : array
    {
        return [
            'base_uri' => $this->baseUri,

            'headers' => [
                'Accept' => 'application/json',
            ],

            // Allow self-signed SSL certificates on development servers
            'verify' => app()->environment('production'),
        ];
    }
}

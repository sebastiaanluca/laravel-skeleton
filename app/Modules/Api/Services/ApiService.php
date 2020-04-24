<?php

declare(strict_types=1);

namespace Modules\Api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Modules\Api\Concerns\DecodesJsonApiResponses;
use Modules\Api\Entities\ApiRequest;
use Modules\Api\Entities\ApiResponse;
use Modules\Api\Entities\Grants\Grant;
use Modules\Api\Exceptions\ApiException;
use Psr\Http\Message\ResponseInterface;

abstract class ApiService
{
    use DecodesJsonApiResponses;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var \Modules\Api\Entities\Grants\Grant
     */
    protected $credentials;

    /**
     * @param string $baseUri
     * @param \Modules\Api\Entities\Grants\Grant $credentials
     */
    public function __construct(string $baseUri, Grant $credentials)
    {
        $this->baseUri = $baseUri;
        $this->credentials = $credentials;

        if (in_array(RefreshesAccessToken::class, class_uses_recursive(static::class), true)) {
            $this->configureAuthenticator(
                $this->baseUri,
                $this->credentials,
                $this->getCachePrefix()
            );
        }
    }

    /**
     * @param \Modules\Api\Entities\ApiRequest $request
     *
     * @return \Modules\Api\Entities\ApiResponse
     */
    public function requestAndDecode(ApiRequest $request) : ApiResponse
    {
        return new ApiResponse(
            $this->decodeJsonResponse(
                $this->request($request)
            )
        );
    }

    /**
     * @param \Modules\Api\Entities\ApiRequest $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Modules\Api\Exceptions\ApiException
     */
    public function request(ApiRequest $request) : ResponseInterface
    {
        $client = $this->createClient();

        $options = array_merge_recursive(
            $client->getConfig(),
            $request->getOptions()
        );

        try {
            $response = $client->request(
                $request->getMethod(),
                $request->getEndpoint(),
                $options
            );
        } catch (ClientException | ServerException $exception) {
            throw $this->handleException($exception);
        }

        return $response;
    }

    /**
     * @param \Modules\Api\Entities\ApiRequest $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function requestWithoutDefaultOptions(ApiRequest $request) : ResponseInterface
    {
        return (new Client)->request(
            $request->getMethod(),
            $request->getEndpoint(),
            $request->getOptions()
        );
    }

    /**
     * @param \GuzzleHttp\Exception\BadResponseException $exception
     *
     * @return \Modules\Api\Exceptions\ApiException
     */
    protected function handleException(BadResponseException $exception) : ApiException
    {
        $statusCode = optional($exception->getResponse())->getStatusCode();

        if ($exception instanceof ClientException && $statusCode === 401) {
            return ApiException::unauthorized($exception->getMessage());
        }

        return ApiException::requestFailed(
            $statusCode,
            $exception->getMessage(),
            $exception->getCode()
        );
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function createClient() : Client
    {
        $options = array_merge_recursive(
            $this->getDefaultClientOptions(),
            ['handler' => $this->createStack()]
        );

        return new Client($options);
    }

    /**
     * @return array
     */
    protected function getDefaultClientOptions() : array
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

    /**
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createStack() : HandlerStack
    {
        return HandlerStack::create(
            new CurlHandler
        );
    }

    /**
     * @return string
     */
    abstract protected function getCachePrefix() : string;
}

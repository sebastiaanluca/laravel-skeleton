<?php

declare(strict_types=1);

namespace Tests\Concerns\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;

class SnapshotClient extends GuzzleClient
{
    use JsonSnapshot;

    /**
     * @var array Request options keys that make a request unique.
     */
    private const UNIQUE_REQUEST_IDENTIFIERS = [
        'base_uri',
        'headers',
        'json',
    ];

    /**
     * @var array Request options keys to ignore to allow making generic,
     * system-independent requests.
     */
    private const IGNORED_REQUEST_IDENTIFIERS = [
        'headers.Authorization',
        'headers.User-Agent',
    ];

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface|mixed
     */
    public function request($method, $uri = '', array $options = [])
    {
        // Define our payload, but explicitly ignore some unique headers
        // so API credentials don't have to be real to get snapshot results
        // when running tests.

        $payload = array_only($options, self::UNIQUE_REQUEST_IDENTIFIERS);
        $payload = array_except($payload, self::IGNORED_REQUEST_IDENTIFIERS);

        $hash = md5(sprintf(
            '%s-%s-%s',
            $method,
            $uri,
            array_hash($payload)
        ));

        $response = $this->snapshot(
            sprintf('%s-%s-%s', $hash, $method, str_slug(str_replace('/', '-', $uri))),
            function () use ($method, $uri, $options) {
                return $this->responseToJson(
                    parent::request($method, $uri, $options)
                );
            }
        );

        return $this->jsonToResponse($response);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string
     */
    public function responseToJson(ResponseInterface $response) : string
    {
        $data = [
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => (string)$response->getBody(),
        ];

        return (string)json_encode($data);
    }

    /**
     * @param string $snapshot
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    private function jsonToResponse(string $snapshot) : GuzzleResponse
    {
        $response = json_decode($snapshot, true);

        return new GuzzleResponse(
            $response['status'],
            $response['headers'],
            $response['body']
        );
    }
}

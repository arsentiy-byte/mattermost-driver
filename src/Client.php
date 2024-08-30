<?php

declare(strict_types=1);

/**
 * This Driver is a PHP implementation of the official Mattermost Web Services API.
 * It allows developers to interact with the API by following the directives
 * outlined in the official documentation.
 *
 * @author Arsentiy Zhunussov <arsentiy.zhunussov@gmail.com>
 *
 * @see https://api.mattermost.com/
 */

namespace Arsentiyz\MattermostDriver;

use Arsentiyz\MattermostDriver\Traits\UrlGenerator;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    use UrlGenerator;

    private PendingRequest $http;

    public function __construct(
        private Config $config,
    ) {
        $this->http = Http::timeout($this->config->timeout);
    }

    public function setToken(string $token): void
    {
        $this->http->withToken($token);
    }

    /**
     * @param array<string, mixed> $query
     *
     * @throws ConnectionException
     */
    public function get(string $uri, array $query = []): PromiseInterface|Response
    {
        return $this->http->get($this->getUri($uri), $query);
    }

    /**
     * @param array<string, mixed> $payload
     *
     * @throws ConnectionException
     */
    public function post(string $uri, array $payload = [], array $query = []): PromiseInterface|Response
    {
        return $this->http->post($this->query($this->getUri($uri), $query), $payload);
    }

    /**
     * @param array<string, mixed> $payload
     *
     * @throws ConnectionException
     */
    public function put(string $uri, array $payload = [], array $query = []): PromiseInterface|Response
    {
        return $this->http->put($this->query($this->getUri($uri), $query), $payload);
    }

    /**
     * @param array<string, mixed> $payload
     *
     * @throws ConnectionException
     */
    public function delete(string $uri, array $payload = [], array $query = []): PromiseInterface|Response
    {
        return $this->http->delete($this->query($this->getUri($uri), $query), $payload);
    }

    private function getUri(string $uri): string
    {
        return sprintf('%s%s', $this->config->getBaseUri(), $uri);
    }
}

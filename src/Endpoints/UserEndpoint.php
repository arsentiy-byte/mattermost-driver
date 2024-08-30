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

namespace Arsentiyz\MattermostDriver\Endpoints;

use Arsentiyz\MattermostDriver\Requests\User\IndexRequest;
use Arsentiyz\MattermostDriver\Requests\User\LoginRequest;
use Arsentiyz\MattermostDriver\Responses\User\IndexResponse;
use Arsentiyz\MattermostDriver\Responses\User\LoginResponse;
use Arsentiyz\MattermostDriver\Responses\User\MeResponse;
use Illuminate\Http\Client\ConnectionException;

final readonly class UserEndpoint extends Endpoint
{
    private const ENDPOINT = '/users';

    /**
     * @throws ConnectionException
     */
    public function login(LoginRequest $request): LoginResponse
    {
        $response = $this->client->post(sprintf('%s/login', self::ENDPOINT), $request->payload());

        return new LoginResponse($response);
    }

    /**
     * @throws ConnectionException
     */
    public function me(): MeResponse
    {
        $response = $this->client->get(sprintf('%s/me', self::ENDPOINT));

        return new MeResponse($response);
    }

    /**
     * @throws ConnectionException
     */
    public function index(IndexRequest $request): IndexResponse
    {
        $response = $this->client->get(self::ENDPOINT, $request->query());

        return new IndexResponse($response);
    }
}

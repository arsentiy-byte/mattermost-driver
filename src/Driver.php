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

use Arsentiyz\MattermostDriver\Contracts\DriverContract;
use Arsentiyz\MattermostDriver\Endpoints\ChannelEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\CommandEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\DialogEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\PostEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\TeamEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\UserEndpoint;
use Arsentiyz\MattermostDriver\Requests\User\LoginRequest;
use Arsentiyz\MattermostDriver\Responses\User\MeResponse;
use Illuminate\Http\Client\ConnectionException;

final class Driver implements DriverContract
{
    private readonly Client $client;

    private array $endpoints = [];

    public function __construct(
        private readonly Config $config,
    ) {
        $this->client = new Client($config);
    }

    /**
     * @throws ConnectionException
     */
    public function authenticate(): MeResponse
    {
        if ($this->isAuthByToken()) {
            $this->client->setToken($this->config->token);

            return $this->getUserEndpoint()->me();
        }

        if ($this->isAuthByUser()) {
            $response = $this->getUserEndpoint()->login(new LoginRequest($this->config->loginId, $this->config->password));

            if ($response->isSuccess() && null !== $response->getToken()) {
                $this->client->setToken($response->getToken());
            }

            return $response->makeMeResponse();
        }

        throw new \RuntimeException('You must provide a login_id and password or a valid token.', 401);
    }

    public function getUserEndpoint(): UserEndpoint
    {
        return $this->getEndpoint(UserEndpoint::class);
    }

    public function getPostEndpoint(): PostEndpoint
    {
        return $this->getEndpoint(PostEndpoint::class);
    }

    public function getTeamEndpoint(): TeamEndpoint
    {
        return $this->getEndpoint(TeamEndpoint::class);
    }

    public function getCommandEndpoint(): CommandEndpoint
    {
        return $this->getEndpoint(CommandEndpoint::class);
    }

    public function getChannelEndpoint(): ChannelEndpoint
    {
        return $this->getEndpoint(ChannelEndpoint::class);
    }

    public function getDialogEndpoint(): DialogEndpoint
    {
        return $this->getEndpoint(DialogEndpoint::class);
    }

    private function getEndpoint(string $name): mixed
    {
        if (!isset($this->endpoints[$name])) {
            $this->endpoints[$name] = new $name($this->client);
        }

        return $this->endpoints[$name];
    }

    private function isAuthByToken(): bool
    {
        return null !== $this->config->token;
    }

    private function isAuthByUser(): bool
    {
        return null !== $this->config->loginId && null !== $this->config->password;
    }
}

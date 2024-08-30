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

use Arsentiyz\MattermostDriver\Requests\Team\ChannelsRequest;
use Arsentiyz\MattermostDriver\Requests\Team\IndexRequest;
use Arsentiyz\MattermostDriver\Responses\Team\ChannelsResponse;
use Arsentiyz\MattermostDriver\Responses\Team\IndexResponse;

final readonly class TeamEndpoint extends Endpoint
{
    private const ENDPOINT = '/teams';

    public function index(IndexRequest $request): IndexResponse
    {
        $response = $this->client->get(self::ENDPOINT, $request->query());

        return new IndexResponse($response);
    }

    public function publicChannels(ChannelsRequest $request): ChannelsResponse
    {
        $response = $this->client->get(
            sprintf('%s/%s/channels', self::ENDPOINT, $request->teamId),
            $request->query()
        );

        return new ChannelsResponse($response);
    }

    public function privateChannels(ChannelsRequest $request): ChannelsResponse
    {
        $response = $this->client->get(
            sprintf('%s/%s/channels/private', self::ENDPOINT, $request->teamId),
            $request->query()
        );

        return new ChannelsResponse($response);
    }
}

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

use Arsentiyz\MattermostDriver\Requests\Post\CreateRequest;
use Arsentiyz\MattermostDriver\Requests\Post\UpdateRequest;
use Arsentiyz\MattermostDriver\Responses\Post\CreateResponse;
use Arsentiyz\MattermostDriver\Responses\Post\UpdateResponse;

final readonly class PostEndpoint extends Endpoint
{
    private const ENDPOINT = '/posts';

    public function create(CreateRequest $request): CreateResponse
    {
        $response = $this->client->post(self::ENDPOINT, $request->payload(), $request->query());

        return new CreateResponse($response);
    }

    public function update(UpdateRequest $request): UpdateResponse
    {
        $response = $this->client->put(
            sprintf('%s/%s', self::ENDPOINT, $request->id),
            $request->payload()
        );

        return new UpdateResponse($response);
    }
}

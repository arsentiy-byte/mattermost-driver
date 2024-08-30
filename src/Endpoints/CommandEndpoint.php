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

use Arsentiyz\MattermostDriver\Requests\Command\CreateRequest;
use Arsentiyz\MattermostDriver\Requests\Command\IndexRequest;
use Arsentiyz\MattermostDriver\Requests\Command\UpdateRequest;
use Arsentiyz\MattermostDriver\Responses\Command\CreateResponse;
use Arsentiyz\MattermostDriver\Responses\Command\DeleteResponse;
use Arsentiyz\MattermostDriver\Responses\Command\IndexResponse;
use Arsentiyz\MattermostDriver\Responses\Command\ShowResponse;
use Arsentiyz\MattermostDriver\Responses\Command\UpdateResponse;

final readonly class CommandEndpoint extends Endpoint
{
    private const ENDPOINT = '/commands';

    public function index(IndexRequest $request): IndexResponse
    {
        $response = $this->client->get(self::ENDPOINT, $request->query());

        return new IndexResponse($response);
    }

    public function create(CreateRequest $request): CreateResponse
    {
        $response = $this->client->post(self::ENDPOINT, $request->payload());

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

    public function delete(string $commandId): DeleteResponse
    {
        $response = $this->client->delete(sprintf('%s/%s', self::ENDPOINT, $commandId));

        return new DeleteResponse($response);
    }

    public function show(string $commandId): ShowResponse
    {
        $response = $this->client->get(sprintf('%s/%s', self::ENDPOINT, $commandId));

        return new ShowResponse($response);
    }
}

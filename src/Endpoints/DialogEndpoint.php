<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Endpoints;

use Arsentiyz\MattermostDriver\Requests\Action\Dialog\OpenRequest;
use Arsentiyz\MattermostDriver\Responses\Action\Dialog\OpenResponse;
use Illuminate\Http\Client\ConnectionException;

final readonly class DialogEndpoint extends Endpoint
{
    private const ENDPOINT = '/actions/dialogs';

    /**
     * @throws ConnectionException
     */
    public function open(OpenRequest $request): OpenResponse
    {
        $response = $this->client->post(
            sprintf('%s/open', self::ENDPOINT),
            $request->payload(),
        );

        return new OpenResponse($response);
    }
}

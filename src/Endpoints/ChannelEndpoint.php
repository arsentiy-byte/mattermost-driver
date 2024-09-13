<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Endpoints;

use Arsentiyz\MattermostDriver\Responses\Channel\DirectResponse;
use Illuminate\Http\Client\ConnectionException;

final readonly class ChannelEndpoint extends Endpoint
{
    private const ENDPOINT = '/channels';

    /**
     * @throws ConnectionException
     */
    public function direct(string $senderId, string $receiverId): DirectResponse
    {
        $response = $this->client->post(
            sprintf('%s/direct', self::ENDPOINT),
            [
                $senderId,
                $receiverId,
            ]
        );

        return new DirectResponse($response);
    }
}

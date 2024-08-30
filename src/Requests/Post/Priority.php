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

namespace Arsentiyz\MattermostDriver\Requests\Post;

/**
 * @phpstan-type PriorityArray array{priority: string, requested_ack: bool}
 */
final readonly class Priority
{
    public function __construct(
        public string $priority,
        public bool $requestedAck,
    ) {}

    /**
     * @return PriorityArray
     */
    public function toArray(): array
    {
        return [
            'priority' => $this->priority,
            'requested_ack' => $this->requestedAck,
        ];
    }
}

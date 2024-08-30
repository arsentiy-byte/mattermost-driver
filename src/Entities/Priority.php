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

namespace Arsentiyz\MattermostDriver\Entities;

use Illuminate\Support\Arr;

final readonly class Priority
{
    public function __construct(
        public string $priority,
        public bool $requestedAck,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'priority'),
            (bool) Arr::get($array, 'requested_ack'),
        );
    }
}

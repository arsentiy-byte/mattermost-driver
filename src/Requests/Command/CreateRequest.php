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

namespace Arsentiyz\MattermostDriver\Requests\Command;

use Arsentiyz\MattermostDriver\Enums\Command\Method;

final readonly class CreateRequest
{
    public function __construct(
        public string $teamId,
        public Method $method,
        public string $trigger,
        public string $url,
    ) {}

    /**
     * @return array{team_id: string, method: string, trigger: string, url: string}
     */
    public function payload(): array
    {
        return [
            'team_id' => $this->teamId,
            'method' => $this->method->value,
            'trigger' => $this->trigger,
            'url' => $this->url,
        ];
    }
}

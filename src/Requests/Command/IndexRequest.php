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

final readonly class IndexRequest
{
    public function __construct(
        public string $teamId,
        public bool $customOnly = false,
    ) {}

    /**
     * @return array{team_id: string, custom_only: bool}
     */
    public function query(): array
    {
        return [
            'team_id' => $this->teamId,
            'custom_only' => $this->customOnly,
        ];
    }
}

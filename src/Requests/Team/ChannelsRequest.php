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

namespace Arsentiyz\MattermostDriver\Requests\Team;

final readonly class ChannelsRequest
{
    public function __construct(
        public string $teamId,
        public int $page = 0,
        public int $perPage = 60
    ) {}

    /**
     * @return array{page: int, per_page: int}
     */
    public function query(): array
    {
        return [
            'page' => $this->page,
            'per_page' => $this->perPage,
        ];
    }
}

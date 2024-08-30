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

use Illuminate\Support\Arr;

final readonly class IndexRequest
{
    public function __construct(
        public int $page = 0,
        public int $perPage = 60,
        public bool $includeTotalCount = false,
        public ?bool $excludePolicyConstrained = null,
    ) {}

    public function query(): array
    {
        $payload = [
            'page' => $this->page,
            'per_page' => $this->perPage,
            'include_total_count' => $this->includeTotalCount,
        ];

        if (null !== $this->excludePolicyConstrained) {
            Arr::set($payload, 'exclude_policy_constrained', $this->excludePolicyConstrained);
        }

        return $payload;
    }
}

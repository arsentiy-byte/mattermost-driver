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
 * @phpstan-import-type PriorityArray from Priority
 *
 * @phpstan-type MetadataArray array{priority: PriorityArray}
 */
final readonly class Metadata
{
    public function __construct(
        public Priority $priority,
    ) {}

    /**
     * @return array{priority: PriorityArray}
     */
    public function toArray(): array
    {
        return [
            'priority' => $this->priority->toArray(),
        ];
    }
}

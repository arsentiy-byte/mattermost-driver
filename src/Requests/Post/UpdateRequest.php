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

use Arsentiyz\MattermostDriver\Entities\Props;

/**
 * @phpstan-type UpdatePostRequestPayload array{id: string, is_pinned: bool, message: string, has_reactions: bool, props?: array}
 */
final readonly class UpdateRequest
{
    public function __construct(
        public string $id,
        public bool $isPinned,
        public string $message,
        public bool $hasReactions,
        public ?Props $props = null,
    ) {}

    /**
     * @return UpdatePostRequestPayload
     */
    public function payload(): array
    {
        return [
            'id' => $this->id,
            'is_pinned' => $this->isPinned,
            'message' => $this->message,
            'has_reactions' => $this->hasReactions,
            'props' => $this->props?->toArray(),
        ];
    }
}

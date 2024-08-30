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

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

final readonly class Post
{
    /**
     * @param array<int, string> $fileIds
     */
    public function __construct(
        public string $id,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public ?CarbonImmutable $editAt,
        public bool $isPinned,
        public string $userId,
        public string $channelId,
        public string $rootId,
        public string $originalId,
        public string $message,
        public string $type,
        public ?array $props,
        public string $hashtags,
        public string $pendingPostId,
        public int $replyCount,
        public ?CarbonImmutable $lastReplyAt,
        public ?array $participants,
        public PostMetadata $metadata,
        public array $fileIds,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);
        $updateAt = (int) Arr::get($array, 'update_at', 0);
        $deleteAt = (int) Arr::get($array, 'delete_at', 0);
        $editAt = (int) Arr::get($array, 'edit_at', 0);
        $lastReplyAt = (int) Arr::get($array, 'last_reply_at', 0);

        return new self(
            Arr::get($array, 'id'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            0 !== $editAt ? CarbonImmutable::parse($editAt) : null,
            (bool) Arr::get($array, 'is_pinned', false),
            Arr::get($array, 'user_id'),
            Arr::get($array, 'channel_id'),
            Arr::get($array, 'root_id'),
            Arr::get($array, 'original_id'),
            Arr::get($array, 'message'),
            Arr::get($array, 'type'),
            Arr::get($array, 'props'),
            Arr::get($array, 'hashtags'),
            Arr::get($array, 'pending_post_id'),
            (int) Arr::get($array, 'reply_count', 0),
            0 !== $lastReplyAt ? CarbonImmutable::parse($lastReplyAt) : null,
            Arr::get($array, 'participants'),
            PostMetadata::fromArray(Arr::get($array, 'metadata', [])),
            Arr::get($array, 'file_ids', []),
        );
    }
}

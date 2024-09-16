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
 * @phpstan-import-type MetadataArray from Metadata
 *
 * @phpstan-type CreatePostRequestQuery array{set_online: bool}
 * @phpstan-type CreatePostRequestPayload array{channel_id: string, message: string, root_id?: string, file_ids?: array<int, string>, props?: array, metadata?: MetadataArray}
 */
final readonly class CreateRequest
{
    public function __construct(
        public bool $setOnline,
        public string $channelId,
        public string $message,
        public ?string $rootId = null,
        public ?array $fileIds = null,
        public ?Props $props = null,
        public ?Metadata $metadata = null,
    ) {}

    /**
     * @return CreatePostRequestQuery
     */
    public function query(): array
    {
        return [
            'set_online' => $this->setOnline,
        ];
    }

    /**
     * @return CreatePostRequestPayload
     */
    public function payload(): array
    {
        return [
            'channel_id' => $this->channelId,
            'message' => $this->message,
            'root_id' => $this->rootId,
            'file_ids' => $this->fileIds,
            'props' => $this->props?->toArray(),
            'metadata' => $this->metadata?->toArray(),
        ];
    }
}

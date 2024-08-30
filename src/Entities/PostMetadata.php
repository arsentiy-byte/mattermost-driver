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

final readonly class PostMetadata
{
    /**
     * @param array<int, Embed>               $embeds
     * @param array<int, Emoji>               $emojis
     * @param array<int, FileInfo>            $files
     * @param array<int, Reaction>            $reactions
     * @param array<int, PostAcknowledgement> $acknowledgements
     */
    public function __construct(
        public array $embeds,
        public array $emojis,
        public array $files,
        public ?array $images,
        public array $reactions,
        public ?Priority $priority,
        public array $acknowledgements
    ) {}

    public static function fromArray(array $array): self
    {
        $priority = Arr::get($array, 'priority');

        return new self(
            Embed::make(Arr::get($array, 'embeds', [])),
            Emoji::make(Arr::get($array, 'emojis', [])),
            FileInfo::make(Arr::get($array, 'files', [])),
            Arr::get($array, 'images'),
            Reaction::make(Arr::get($array, 'reactions', [])),
            null !== $priority ? Priority::fromArray($priority) : null,
            PostAcknowledgement::make(Arr::get($array, 'acknowledgements', [])),
        );
    }
}

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

final readonly class Reaction
{
    public function __construct(
        public string $userId,
        public string $postId,
        public string $emojiName,
        public ?CarbonImmutable $createAt,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);

        return new self(
            Arr::get($array, 'user_id'),
            Arr::get($array, 'post_id'),
            Arr::get($array, 'emoji_name'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $reactions): array
    {
        return Arr::map($reactions, static fn ($reaction) => self::fromArray($reaction));
    }
}

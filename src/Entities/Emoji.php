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

final readonly class Emoji
{
    public function __construct(
        public string $id,
        public string $creatorId,
        public string $name,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);
        $updateAt = (int) Arr::get($array, 'update_at', 0);
        $deleteAt = (int) Arr::get($array, 'delete_at', 0);

        return new self(
            Arr::get($array, 'id'),
            Arr::get($array, 'creator_id'),
            Arr::get($array, 'name'),
            0 !== $createAt ? CarbonImmutable::createFromTimestamp($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::createFromTimestamp($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::createFromTimestamp($deleteAt) : null,
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $emojis): array
    {
        return Arr::map($emojis, static fn (array $emoji) => self::fromArray($emoji));
    }
}

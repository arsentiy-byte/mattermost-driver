<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities;

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

/**
 * This Driver is a PHP implementation of the official Mattermost Web Services API.
 * It allows developers to interact with the API by following the directives
 * outlined in the official documentation.
 *
 * @author Arsentiy Zhunussov <arsentiy.zhunussov@gmail.com>
 *
 * @see https://api.mattermost.com/
 */
final readonly class Channel
{
    public function __construct(
        public string $id,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public string $teamId,
        public string $type,
        public string $displayName,
        public string $name,
        public string $header,
        public string $purpose,
        public ?CarbonImmutable $lastPostAt,
        public int $totalMessageCount,
        public ?CarbonImmutable $extraUpdateAt,
        public string $creatorId,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);
        $updateAt = (int) Arr::get($array, 'update_at', 0);
        $deleteAt = (int) Arr::get($array, 'delete_at', 0);
        $lastPostAt = (int) Arr::get($array, 'last_post_at', 0);
        $extraUpdateAt = (int) Arr::get($array, 'extra_update_at', 0);

        return new self(
            Arr::get($array, 'id'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            Arr::get($array, 'team_id'),
            Arr::get($array, 'type'),
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            Arr::get($array, 'header'),
            Arr::get($array, 'purpose'),
            0 !== $lastPostAt ? CarbonImmutable::parse($lastPostAt) : null,
            (int) Arr::get($array, 'total_msg_count'),
            0 !== $extraUpdateAt ? CarbonImmutable::parse($extraUpdateAt) : null,
            Arr::get($array, 'creator_id'),
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $channels): array
    {
        return Arr::map($channels, static fn (array $channel) => self::fromArray($channel));
    }
}

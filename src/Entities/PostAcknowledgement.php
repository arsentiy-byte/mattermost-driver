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

final readonly class PostAcknowledgement
{
    public function __construct(
        public string $userId,
        public string $postId,
        public ?CarbonImmutable $acknowledgedAt,
    ) {}

    public static function fromArray(array $array): self
    {
        $acknowledgedAt = (int) Arr::get($array, 'acknowledged_at', 0);

        return new self(
            Arr::get($array, 'user_id'),
            Arr::get($array, 'post_id'),
            0 !== $acknowledgedAt ? CarbonImmutable::parse($acknowledgedAt) : null,
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $acknowledgements): array
    {
        return Arr::map($acknowledgements, static fn (array $acknowledgement): self => self::fromArray($acknowledgement));
    }
}

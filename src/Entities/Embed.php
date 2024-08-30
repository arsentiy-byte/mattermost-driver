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

use Arsentiyz\MattermostDriver\Enums\Embed\Type;
use Illuminate\Support\Arr;

final readonly class Embed
{
    public function __construct(
        public Type $type,
        public ?string $url,
        public ?array $data,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(
            Type::from(Arr::get($array, 'type')),
            Arr::get($array, 'url'),
            Arr::get($array, 'data'),
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $embeds): array
    {
        return Arr::map($embeds, static fn (array $embed): self => self::fromArray($embed));
    }
}

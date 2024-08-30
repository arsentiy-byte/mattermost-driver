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

final readonly class Timezone
{
    public function __construct(
        public bool $useAutomaticTimezone,
        public ?string $manualTimezone,
        public ?string $automaticTimezone,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(
            (bool) Arr::get($array, 'useAutomaticTimezone'),
            Arr::get($array, 'manualTimezone'),
            Arr::get($array, 'automaticTimezone'),
        );
    }
}

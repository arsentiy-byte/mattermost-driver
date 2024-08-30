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

final readonly class NotifyProps
{
    public function __construct(
        public string $email,
        public string $push,
        public string $desktop,
        public string $desktopSound,
        public string $mentionKeys,
        public string $channel,
        public string $firstName,
    ) {}

    public static function fromArray(array $array): self
    {
        return new NotifyProps(
            Arr::get($array, 'email'),
            Arr::get($array, 'push'),
            Arr::get($array, 'desktop'),
            Arr::get($array, 'desktop_sound'),
            Arr::get($array, 'mention_keys'),
            Arr::get($array, 'channel'),
            Arr::get($array, 'first_name'),
        );
    }
}

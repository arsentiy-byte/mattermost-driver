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

namespace Arsentiyz\MattermostDriver\DTO;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final readonly class CommandRequestDTO
{
    public function __construct(
        public string $channelId,
        public string $channelName,
        public string $command,
        public string $responseUrl,
        public string $teamDomain,
        public string $teamId,
        public ?string $text,
        public string $token,
        public string $triggerId,
        public string $userId,
        public string $userName,
    ) {}

    /**
     * @param array<string, string> $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'channel_id'),
            Arr::get($array, 'channel_name'),
            Arr::get($array, 'command'),
            Arr::get($array, 'response_url'),
            Arr::get($array, 'team_domain'),
            Arr::get($array, 'team_id'),
            Arr::get($array, 'text'),
            Arr::get($array, 'token'),
            Arr::get($array, 'trigger_id'),
            Arr::get($array, 'user_id'),
            Arr::get($array, 'user_name'),
        );
    }

    /**
     * @return array<int, string>
     */
    public function getArguments(): array
    {
        if (null === $this->text) {
            return [];
        }

        if (empty(Str::trim($this->text))) {
            return [];
        }

        return explode(' ', Str::trim($this->text));
    }
}

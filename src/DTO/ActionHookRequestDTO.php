<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO;

use Illuminate\Support\Arr;

final readonly class ActionHookRequestDTO
{
    public function __construct(
        public string $userId,
        public string $userName,
        public string $channelId,
        public string $channelName,
        public ?string $teamId,
        public ?string $teamDomain,
        public string $postId,
        public ?string $triggerId,
        public ?string $type,
        public ?string $dataSource,
        public array $context,
    ) {}

    /**
     * @param array{user_id: string, user_name: string, channel_id: string, channel_name: string, team_id?: string, team_domain?: string, post_id: string, trigger_id?: string, type?: string, data_source?: string, context?: array} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'user_id'),
            Arr::get($array, 'user_name'),
            Arr::get($array, 'channel_id'),
            Arr::get($array, 'channel_name'),
            Arr::get($array, 'team_id'),
            Arr::get($array, 'team_domain'),
            Arr::get($array, 'post_id'),
            Arr::get($array, 'trigger_id'),
            Arr::get($array, 'type'),
            Arr::get($array, 'data_source'),
            Arr::get($array, 'context', []),
        );
    }

    public function context(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->context, $key, $default);
    }
}

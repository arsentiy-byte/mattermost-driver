<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO;

use Illuminate\Support\Arr;

final readonly class DialogRequestDTO
{
    public function __construct(
        public string $type,
        public ?string $callbackId,
        public ?string $state,
        public string $userId,
        public string $channelId,
        public ?string $teamId,
        public ?array $submission,
        public bool $cancelled,
    ) {}

    /**
     * @param array{type: string, callback_id?: string, state?: string, user_id: string, channel_id: string, team_id?: string, submission?: array, cancelled?: bool} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'type'),
            Arr::get($data, 'callback_id'),
            Arr::get($data, 'state'),
            Arr::get($data, 'user_id'),
            Arr::get($data, 'channel_id'),
            Arr::get($data, 'team_id'),
            Arr::get($data, 'submission'),
            (bool) Arr::get($data, 'cancelled', false),
        );
    }

    public function submission(?string $key = null, mixed $default = null): mixed
    {
        return Arr::get($this->submission, $key, $default);
    }
}

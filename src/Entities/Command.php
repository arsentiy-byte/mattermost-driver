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

use Arsentiyz\MattermostDriver\Enums\Command\Method;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

final readonly class Command
{
    public function __construct(
        public ?string $id,
        public ?string $token,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public ?string $creatorId,
        public ?string $teamId,
        public string $trigger,
        public ?Method $method,
        public ?string $username,
        public ?string $iconUrl,
        public bool $autoComplete,
        public ?string $autoCompleteDesc,
        public ?string $autoCompleteHint,
        public string $displayName,
        public ?string $description,
        public ?string $url,
    ) {}

    public static function fromArray(array $data): self
    {
        $createAt = (int) Arr::get($data, 'create_at', 0);
        $updateAt = (int) Arr::get($data, 'update_at', 0);
        $deleteAt = (int) Arr::get($data, 'delete_at', 0);
        $method = Arr::get($data, 'method');

        return new self(
            Arr::get($data, 'id') ?: null,
            Arr::get($data, 'token') ?: null,
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            Arr::get($data, 'creator_id') ?: null,
            Arr::get($data, 'team_id') ?: null,
            Arr::get($data, 'trigger'),
            empty($method) ? null : Method::from($method),
            Arr::get($data, 'username') ?: null,
            Arr::get($data, 'icon_url') ?: null,
            (bool) Arr::get($data, 'auto_complete'),
            Arr::get($data, 'auto_complete_desc') ?: null,
            Arr::get($data, 'auto_complete_hint') ?: null,
            Arr::get($data, 'display_name'),
            Arr::get($data, 'description') ?: null,
            Arr::get($data, 'url') ?: null,
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $commands): array
    {
        return Arr::map($commands, static fn (array $command) => self::fromArray($command));
    }
}

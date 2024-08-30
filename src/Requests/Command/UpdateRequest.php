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

namespace Arsentiyz\MattermostDriver\Requests\Command;

use Arsentiyz\MattermostDriver\Enums\Command\Method;
use Carbon\CarbonImmutable;

final readonly class UpdateRequest
{
    public function __construct(
        public string $id,
        public string $token,
        public CarbonImmutable $createAt,
        public CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public string $creatorId,
        public string $teamId,
        public string $trigger,
        public Method $method,
        public string $username,
        public string $iconUrl,
        public bool $autoComplete,
        public ?string $autoCompleteDesc,
        public ?string $autoCompleteHint,
        public string $displayName,
        public ?string $description,
        public string $url,
    ) {}

    /**
     * @return array{id: string, token: string, create_at: int, update_at: int, delete_at: int, creator_id: string, team_id: string, trigger: string, method: string, username: string, icon_url: string, auto_complete: bool, auto_complete_desc?: string, auto_complete_hint?: string, display_name: string, description?: string, url: string}
     */
    public function payload(): array
    {
        return [
            'id' => $this->id,
            'token' => $this->token,
            'create_at' => $this->createAt->getTimestamp(),
            'update_at' => $this->updateAt->getTimestamp(),
            'delete_at' => $this->deleteAt?->getTimestamp() ?? 0,
            'creator_id' => $this->creatorId,
            'team_id' => $this->teamId,
            'trigger' => $this->trigger,
            'method' => $this->method->value,
            'username' => $this->username,
            'icon_url' => $this->iconUrl,
            'auto_complete' => $this->autoComplete,
            'auto_complete_desc' => $this->autoCompleteDesc,
            'auto_complete_hint' => $this->autoCompleteHint,
            'display_name' => $this->displayName,
            'description' => $this->description,
            'url' => $this->url,
        ];
    }
}

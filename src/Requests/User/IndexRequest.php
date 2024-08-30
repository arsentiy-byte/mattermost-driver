<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Requests\User;

use Arsentiyz\MattermostDriver\Enums\Post\Sort;
use Illuminate\Support\Arr;

/**
 * @phpstan-type IndexRequestQuery array{page: int, per_page: int, in_team?: string, not_in_team?: string, in_channel?: string, not_in_channel?: string, in_group?: string, group_constrained?: bool, without_team?: bool, active?: bool, inactive?: bool, role?: string, sort?: string, roles?: string, channel_roles?: string, team_roles?: string}
 */
final readonly class IndexRequest
{
    /**
     * @param null|array<int, string> $roles
     * @param null|array<int, string> $channelRoles
     * @param null|array<int, string> $teamRoles
     */
    public function __construct(
        public int $page = 0,
        public int $perPage = 60,
        public ?string $inTeam = null,
        public ?string $notInTeam = null,
        public ?string $inChannel = null,
        public ?string $notInChannel = null,
        public ?string $inGroup = null,
        public ?bool $groupConstrained = null,
        public ?bool $withoutTeam = null,
        public ?bool $active = null,
        public ?bool $inactive = null,
        public ?string $role = null,
        public ?Sort $sort = null,
        public ?array $roles = null,
        public ?array $channelRoles = null,
        public ?array $teamRoles = null,
    ) {}

    /**
     * @return IndexRequestQuery
     */
    public function query(): array
    {
        $array = [
            'page' => $this->page,
            'per_page' => $this->perPage,
        ];

        if (!empty($this->inTeam)) {
            Arr::set($array, 'in_team', $this->inTeam);
        }

        if (!empty($this->notInTeam)) {
            Arr::set($array, 'not_in_team', $this->notInTeam);
        }

        if (!empty($this->inChannel)) {
            Arr::set($array, 'in_channel', $this->inChannel);
        }

        if (!empty($this->notInChannel)) {
            Arr::set($array, 'not_in_channel', $this->notInChannel);
        }

        if (!empty($this->inGroup)) {
            Arr::set($array, 'in_group', $this->inGroup);
        }

        if (null !== $this->groupConstrained) {
            Arr::set($array, 'group_constrained', $this->groupConstrained);
        }

        if (null !== $this->withoutTeam) {
            Arr::set($array, 'without_team', $this->withoutTeam);
        }

        if (null !== $this->active) {
            Arr::set($array, 'active', $this->active);
        }

        if (null !== $this->inactive) {
            Arr::set($array, 'inactive', $this->inactive);
        }

        if (!empty($this->role)) {
            Arr::set($array, 'role', $this->role);
        }

        if (null !== $this->sort) {
            Arr::set($array, 'sort', $this->sort->value);
        }

        if (!empty($this->roles)) {
            Arr::set($array, 'roles', implode(',', $this->roles));
        }

        if (!empty($this->channelRoles)) {
            Arr::set($array, 'channel_roles', implode(',', $this->channelRoles));
        }

        if (!empty($this->teamRoles)) {
            Arr::set($array, 'team_roles', implode(',', $this->teamRoles));
        }

        return $array;
    }
}

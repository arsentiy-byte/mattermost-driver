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

final readonly class Team
{
    public function __construct(
        public string $id,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public string $displayName,
        public string $name,
        public string $description,
        public string $email,
        public string $type,
        public string $companyName,
        public string $allowedDomains,
        public string $inviteId,
        public bool $allowOpenInvite,
        public ?string $schemeId,
        public bool $groupConstrained,
        public ?string $policyId,
        public bool $cloudLimitsArchived,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);
        $updateAt = (int) Arr::get($array, 'update_at', 0);
        $deleteAt = (int) Arr::get($array, 'delete_at', 0);

        return new self(
            Arr::get($array, 'id'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            Arr::get($array, 'description'),
            Arr::get($array, 'email'),
            Arr::get($array, 'type'),
            Arr::get($array, 'company_name'),
            Arr::get($array, 'allowed_domains'),
            Arr::get($array, 'invite_id'),
            (bool) Arr::get($array, 'allow_open_invite'),
            Arr::get($array, 'scheme_id'),
            (bool) Arr::get($array, 'group_constrained'),
            Arr::get($array, 'policy_id'),
            (bool) Arr::get($array, 'cloud_limits_archived'),
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $teams): array
    {
        return Arr::map($teams, static fn ($team) => self::fromArray($team));
    }
}

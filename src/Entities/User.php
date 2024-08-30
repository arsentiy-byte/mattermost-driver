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

final readonly class User
{
    public function __construct(
        public string $id,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public string $username,
        public string $firstName,
        public string $lastName,
        public string $nickname,
        public string $email,
        public bool $emailVerified,
        public string $authService,
        public string $roles,
        public string $locale,
        public ?NotifyProps $notifyProps,
        public ?array $props,
        public ?CarbonImmutable $lastPasswordUpdate,
        public ?CarbonImmutable $lastPictureUpdate,
        public int $failedAttempts,
        public bool $mfaActive,
        public Timezone $timezone,
        public ?string $termsOfServiceId,
        public ?CarbonImmutable $termsOfServiceCreateAt,
    ) {}

    public static function fromArray(array $array): self
    {
        $notifyProps = Arr::get($array, 'notify_props');
        $timezone = Arr::get($array, 'timezone');
        $createAt = Arr::get($array, 'create_at', 0);
        $updateAt = Arr::get($array, 'update_at', 0);
        $deleteAt = Arr::get($array, 'delete_at', 0);
        $termsOfServiceCreateAt = Arr::get($array, 'terms_of_service_create_at', 0);
        $lastPasswordUpdate = Arr::get($array, 'last_password_update', 0);
        $lastPictureUpdate = Arr::get($array, 'last_picture_update', 0);

        return new User(
            Arr::get($array, 'id'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            Arr::get($array, 'username'),
            Arr::get($array, 'first_name'),
            Arr::get($array, 'last_name'),
            Arr::get($array, 'nickname'),
            Arr::get($array, 'email'),
            (bool) Arr::get($array, 'email_verified'),
            Arr::get($array, 'auth_service'),
            Arr::get($array, 'roles'),
            Arr::get($array, 'locale'),
            null !== $notifyProps ? NotifyProps::fromArray($notifyProps) : null,
            Arr::get($array, 'props'),
            0 !== $lastPasswordUpdate ? CarbonImmutable::parse($lastPasswordUpdate) : null,
            0 !== $lastPictureUpdate ? CarbonImmutable::parse($lastPictureUpdate) : null,
            (int) Arr::get($array, 'failed_attempts'),
            (bool) Arr::get($array, 'mfa_active'),
            Timezone::fromArray($timezone),
            Arr::get($array, 'terms_of_service_id'),
            0 !== $termsOfServiceCreateAt ? CarbonImmutable::parse($termsOfServiceCreateAt) : null,
        );
    }
}

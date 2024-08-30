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

namespace Arsentiyz\MattermostDriver\Requests\User;

final readonly class LoginRequest
{
    public function __construct(
        public string $loginId,
        public string $password,
    ) {}

    /**
     * @return array{login_id: string, password: string}
     */
    public function payload(): array
    {
        return [
            'login_id' => $this->loginId,
            'password' => $this->password,
        ];
    }
}

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

namespace Arsentiyz\MattermostDriver;

final class Config
{
    public function __construct(
        public string $host = 'http://localhost',
        public string $basePath = '/api/v4',
        public ?string $loginId = null,
        public ?string $password = null,
        public ?string $token = null,
        public int $timeout = 5,
    ) {}

    public function getBaseUri(): string
    {
        return sprintf('%s%s', $this->host, $this->basePath);
    }
}

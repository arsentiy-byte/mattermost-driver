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

use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;

final class Mattermost
{
    /**
     * @var array<string, Driver>
     */
    private array $servers = [];

    public function __construct(
        private Application $application,
    ) {}

    public function server(?string $name = null): Driver
    {
        $name = $this->parseServerName($name);

        if (!Arr::exists($this->servers, $name)) {
            Arr::set($this->servers, $name, $this->makeConnection($name));
        }

        return Arr::get($this->servers, $name);
    }

    private function makeConnection(string $name): Driver
    {
        $configuration = $this->configuration($name);

        $driverConfig = match (Arr::get($configuration, 'auth', 'default')) {
            'bearer' => new Config(
                host: Arr::get($configuration, 'host'),
                basePath: Arr::get($configuration, 'api'),
                token: Arr::get($configuration, 'token'),
                timeout: (int) Arr::get($configuration, 'timeout'),
            ),
            default => new Config(
                host: Arr::get($configuration, 'host'),
                basePath: Arr::get($configuration, 'api'),
                loginId: Arr::get($configuration, 'login'),
                password: Arr::get($configuration, 'password'),
                timeout: (int) Arr::get($configuration, 'timeout'),
            ),
        };

        $driver = new Driver($driverConfig);

        $response = $driver->authenticate();

        if ($response->isFailed()) {
            throw new \RuntimeException(
                sprintf('Failed to authenticate with server %s: %s.', $name, $response->getReason()),
                $response->getStatus()
            );
        }

        return $driver;
    }

    private function configuration(string $name): array
    {
        $name = $this->parseServerName($name);

        $servers = $this->application['config']['mattermost.servers'];

        if (!Arr::exists($servers, $name)) {
            throw new \InvalidArgumentException(sprintf('Server %s not configured.', $name));
        }

        return Arr::get($servers, $name);
    }

    private function parseServerName(?string $name): string
    {
        return empty($name) ? $this->getDefaultServer() : $name;
    }

    private function getDefaultServer(): string
    {
        return $this->application['config']['mattermost.default'];
    }
}

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

namespace Arsentiyz\MattermostDriver\Responses;

abstract class Response
{
    public function __construct(
        protected \Illuminate\Http\Client\Response $response,
    ) {}

    public function isFailed(): bool
    {
        return $this->response->failed();
    }

    public function isSuccess(): bool
    {
        return $this->response->successful();
    }

    public function getStatus(): int
    {
        return $this->response->status();
    }

    public function getReason(): string
    {
        return $this->response->reason();
    }

    /**
     * @return array<string, mixed>
     */
    public function getBody(): array
    {
        return $this->response->json();
    }

    public function getErrorResponse(): ?ErrorResponse
    {
        if ($this->isFailed()) {
            return new ErrorResponse($this->response);
        }

        return null;
    }

    protected function body(string $key, mixed $default = null): mixed
    {
        return $this->response->json($key, $default);
    }

    protected function header(string $header): string
    {
        return $this->response->header($header);
    }
}

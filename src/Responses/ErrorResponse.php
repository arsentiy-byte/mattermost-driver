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

final class ErrorResponse extends Response
{
    public function getId(): ?string
    {
        return $this->body('id');
    }

    public function getMessage(): ?string
    {
        return $this->body('message');
    }

    public function getDetailedError(): ?string
    {
        return $this->body('detailed_error');
    }

    public function getRequestId(): ?string
    {
        return $this->body('request_id');
    }

    public function getStatusCode(): int
    {
        return (int) $this->body('status_code', 0);
    }

    /**
     * @return array{id: string, message: string, detailed_error: string, request_id: string, status_code: int}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'message' => $this->getMessage(),
            'detailed_error' => $this->getDetailedError(),
            'request_id' => $this->getRequestId(),
            'status_code' => $this->getStatusCode(),
        ];
    }
}

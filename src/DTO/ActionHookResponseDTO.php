<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO;

use Arsentiyz\MattermostDriver\DTO\ActionHookResponseDTO\Update;

final readonly class ActionHookResponseDTO
{
    public function __construct(
        public ?Update $update = null,
        public ?string $ephemeralText = null,
    ) {
        if (null === $this->update && null === $this->ephemeralText) {
            throw new \InvalidArgumentException('Either update or ephemeral_text must be set');
        }
    }

    /**
     * @return array{update?: array<string, mixed>, ephemeral_text?: string}
     */
    public function map(): array
    {
        return [
            'update' => $this->update->map(),
            'ephemeral_text' => $this->ephemeralText,
        ];
    }
}

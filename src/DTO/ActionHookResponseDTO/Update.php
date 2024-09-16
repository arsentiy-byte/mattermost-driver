<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO\ActionHookResponseDTO;

use Arsentiyz\MattermostDriver\Entities\Props;

final readonly class Update
{
    public function __construct(
        public string $message,
        public ?Props $props = null,
    ) {}

    /**
     * @return array<string, mixed>|array{message: string, props?: array}
     */
    public function map(): array
    {
        return [
            'message' => $this->message,
            'props' => $this->props?->toArray(),
        ];
    }
}

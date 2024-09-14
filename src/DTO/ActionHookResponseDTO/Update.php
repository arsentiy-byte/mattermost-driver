<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO\ActionHookResponseDTO;

use Illuminate\Support\Arr;

final readonly class Update
{
    public function __construct(
        public string $message,
        public ?array $props = null,
    ) {}

    /**
     * @return array<string, mixed>|array{message: string, props?: array}
     */
    public function toArray(): array
    {
        $array = [
            'message' => $this->message,
        ];

        if (null !== $this->props) {
            Arr::set($array, 'props', $this->props);
        }

        return $array;
    }
}

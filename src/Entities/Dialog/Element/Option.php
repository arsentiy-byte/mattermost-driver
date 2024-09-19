<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog\Element;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

final readonly class Option implements Arrayable
{
    public function __construct(
        public string $text,
        public string $value,
    ) {}

    /**
     * @param array{text: string, value: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'text'),
            Arr::get($array, 'value'),
        );
    }

    /**
     * @return array{text: string, value: string}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'value' => $this->value,
        ];
    }
}

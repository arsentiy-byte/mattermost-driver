<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Attachment;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

final class Field implements Arrayable
{
    public function __construct(
        private bool $short,
        private string $title,
        private string $value,
    ) {}

    /**
     * @param array{short: bool, title: string, value: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            (bool) Arr::get($array, 'short'),
            Arr::get($array, 'title'),
            Arr::get($array, 'value'),
        );
    }

    /**
     * @return array{short: bool, title: string, value: string}
     */
    public function toArray(): array
    {
        return [
            'short' => $this->short,
            'title' => $this->title,
            'value' => $this->value,
        ];
    }

    public function setShort(bool $short): self
    {
        $this->short = $short;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}

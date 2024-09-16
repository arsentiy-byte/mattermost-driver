<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities;

use Arsentiyz\MattermostDriver\Collections\AttachmentCollection;
use Illuminate\Support\Arr;

final readonly class Props
{
    public function __construct(
        private array $props = [],
        private ?AttachmentCollection $attachmentCollection = null,
    ) {}

    /**
     * @param array{props?: array, attachments?: array} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'props', []),
            AttachmentCollection::make(Arr::get($array, 'attachments', [])),
        );
    }

    /**
     * @return array{string, mixed}
     */
    public function toArray(): array
    {
        return array_merge($this->props, [
            'attachments' => $this->attachmentCollection?->toArray() ?? [],
        ]);
    }
}

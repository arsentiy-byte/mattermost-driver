<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Collections;

use Arsentiyz\MattermostDriver\Entities\Attachment;
use Illuminate\Support\Collection;

final class AttachmentCollection extends Collection
{
    /**
     * @param array{int, array{fallback?: string, color?: string, pretext?: string, text?: string, author_name?: string, author_link?: string, author_icon?: string, title?: string, title_link?: string, fields?: array, actions?: array}} $items
     */
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(Attachment::fromArray($item));
        }

        return $self;
    }

    /**
     * @param Attachment $item
     */
    public function add($item): self
    {
        if (!$item instanceof Attachment) {
            throw new \RuntimeException(sprintf('Item must be an instance of %s', Attachment::class));
        }

        return parent::add($item);
    }

    /**
     * @return array<int, array{fallback?: string, color?: string, pretext?: string, text?: string, author_name?: string, author_link?: string, author_icon?: string, title?: string, title_link?: string, fields?: array, actions?: array}>
     */
    public function toArray(): array
    {
        return $this
            ->map(static fn (Attachment $attachment): array => $attachment->toArray())
            ->toArray();
    }
}

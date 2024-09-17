<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Collections;

use Arsentiyz\MattermostDriver\Entities\Attachment\Action;
use Illuminate\Support\Collection;

final class ActionCollection extends Collection
{
    /**
     * @param array{int, array{name: string, integration: array, style?: string, type?: string, data_source?: string}} $items
     */
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(Action::fromArray($item));
        }

        return $self;
    }

    /**
     * @param Action $item
     */
    public function add($item): self
    {
        if (!$item instanceof Action) {
            throw new \RuntimeException(sprintf('Item must be an instance of %s', Action::class));
        }

        return parent::add($item);
    }
}

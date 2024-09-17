<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Collections;

use Arsentiyz\MattermostDriver\Entities\Attachment\Field;
use Illuminate\Support\Collection;

final class FieldCollection extends Collection
{
    /**
     * @param array{int, array{short: bool, title: string, value: string}} $items
     */
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(Field::fromArray($item));
        }

        return $self;
    }

    /**
     * @param Field $item
     */
    public function add($item): self
    {
        if (!$item instanceof Field) {
            throw new \RuntimeException(sprintf('Item must be an instance of %s', Field::class));
        }

        return parent::add($item);
    }
}

<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Collections\Dialog\Element;

use Arsentiyz\MattermostDriver\Entities\Dialog\Element\Option;
use Illuminate\Support\Collection;

final class OptionCollection extends Collection
{
    /**
     * @param array<int, array{text: string, value: string}> $items
     */
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(Option::fromArray($item));
        }

        return $self;
    }

    /**
     * @param Option $item
     */
    public function add($item): self
    {
        if (!$item instanceof Option) {
            throw new \RuntimeException(sprintf('Item must be an instance of %s', Option::class));
        }

        return parent::add($item);
    }
}

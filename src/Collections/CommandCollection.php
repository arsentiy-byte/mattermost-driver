<?php

declare(strict_types=1);

/**
 * This Driver is a PHP implementation of the official Mattermost Web Services API.
 * It allows developers to interact with the API by following the directives
 * outlined in the official documentation.
 *
 * @author Arsentiy Zhunussov <arsentiy.zhunussov@gmail.com>
 *
 * @see https://api.mattermost.com/
 */

namespace Arsentiyz\MattermostDriver\Collections;

use Arsentiyz\MattermostDriver\Entities\Command;
use Illuminate\Support\Collection;

final class CommandCollection extends Collection
{
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(Command::fromArray($item));
        }

        return $self;
    }

    /**
     * @param Command $item
     */
    public function add($item): self
    {
        if (!$item instanceof Command) {
            throw new \RuntimeException(sprintf('Item must be an instance of %s', Command::class));
        }

        return parent::add($item);
    }
}

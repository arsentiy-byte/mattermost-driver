<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Responses\Command;

use Arsentiyz\MattermostDriver\Entities\Command;
use Arsentiyz\MattermostDriver\Responses\Response;

final class ShowResponse extends Response
{
    public function getCommand(): ?Command
    {
        if ($this->isFailed()) {
            return null;
        }

        return Command::fromArray($this->getBody());
    }
}

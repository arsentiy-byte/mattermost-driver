<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Responses\Channel;

use Arsentiyz\MattermostDriver\Entities\Channel;
use Arsentiyz\MattermostDriver\Responses\Response;

final class DirectResponse extends Response
{
    public function getChannel(): ?Channel
    {
        if ($this->isFailed()) {
            return null;
        }

        return Channel::fromArray($this->getBody());
    }
}

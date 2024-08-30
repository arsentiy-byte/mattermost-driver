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

namespace Arsentiyz\MattermostDriver\Responses\Command;

use Arsentiyz\MattermostDriver\Collections\CommandCollection;
use Arsentiyz\MattermostDriver\Responses\Response;

final class IndexResponse extends Response
{
    public function getCommands(): ?CommandCollection
    {
        if ($this->isFailed()) {
            return null;
        }

        return CommandCollection::make($this->getBody());
    }
}

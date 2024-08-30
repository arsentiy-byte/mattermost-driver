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

namespace Arsentiyz\MattermostDriver\Responses\Team;

use Arsentiyz\MattermostDriver\Collections\TeamCollection;
use Arsentiyz\MattermostDriver\Responses\Response;

final class IndexResponse extends Response
{
    public function getTeams(): ?TeamCollection
    {
        if ($this->isFailed()) {
            return null;
        }

        return TeamCollection::make($this->getBody());
    }
}

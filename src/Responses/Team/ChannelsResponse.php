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

use Arsentiyz\MattermostDriver\Collections\ChannelCollection;
use Arsentiyz\MattermostDriver\Responses\Response;

final class ChannelsResponse extends Response
{
    public function getChannels(): ?ChannelCollection
    {
        if ($this->isFailed()) {
            return null;
        }

        return ChannelCollection::make($this->getBody());
    }
}

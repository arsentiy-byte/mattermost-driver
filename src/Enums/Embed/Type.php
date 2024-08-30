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

namespace Arsentiyz\MattermostDriver\Enums\Embed;

enum Type: string
{
    case IMAGE = 'image';
    case MESSAGE_ATTACHMENT = 'message_attachment';
    case OPENGRAPH = 'opengraph';
    case LINK = 'link';
}

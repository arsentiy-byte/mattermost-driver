<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Attachment\Action;

enum DataSource: string
{
    case CHANNELS = 'channels';
    case USERS = 'users';
}

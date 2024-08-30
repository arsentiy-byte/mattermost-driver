<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Post;

enum Sort: string
{
    case LAST_ACTIVITY_AT = 'last_activity_at';
    case CREATE_AT = 'create_at';
    case STATUS = 'status';
    case DISPLAY_NAME = 'display_name';
}

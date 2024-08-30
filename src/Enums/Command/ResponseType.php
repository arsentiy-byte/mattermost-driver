<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Command;

enum ResponseType: string
{
    case EPHEMERAL = 'ephemeral';
    case IN_CHANNEL = 'in_channel';
}

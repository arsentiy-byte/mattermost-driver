<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Attachment\Action;

enum Style: string
{
    case DEFAULT = 'default';
    case PRIMARY = 'primary';
    case WARNING = 'warning';
    case DANGER = 'danger';
    case SUCCESS = 'success';
}

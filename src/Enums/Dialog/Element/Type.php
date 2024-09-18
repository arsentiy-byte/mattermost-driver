<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Dialog\Element;

enum Type: string
{
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case SELECT = 'select';
    case RADIO = 'radio';
    case BOOL = 'bool';
}

<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Enums\Dialog\Element;

enum Subtype: string
{
    case TEXT = 'text';
    case EMAIL = 'email';
    case NUMBER = 'number';
    case PASSWORD = 'password';
    case TEL = 'tel';
    case URL = 'url';
}

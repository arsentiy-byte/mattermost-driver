<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog\Element;

use Arsentiyz\MattermostDriver\Entities\Dialog\Element;
use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Type;
use Illuminate\Support\Arr;

final class BoolElement extends Element
{
    public function __construct(
        string $displayName,
        string $name,
        bool $optional = false,
        ?string $helpText = null,
        mixed $default = null,
        ?string $placeholder = null,
    ) {
        parent::__construct(
            $displayName,
            $name,
            Type::BOOL,
            $optional,
            $helpText,
            $default,
            $placeholder
        );
    }

    /**
     * @param array{display_name: string, name: string, optional?: bool, help_text?: string, default?: mixed, placeholder?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            (bool) Arr::get($array, 'optional', false),
            Arr::get($array, 'help_text'),
            Arr::get($array, 'default'),
            Arr::get($array, 'placeholder'),
        );
    }
}

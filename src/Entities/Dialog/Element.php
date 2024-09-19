<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog;

use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Type;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

abstract class Element implements Arrayable
{
    public function __construct(
        protected string $displayName,
        protected string $name,
        protected Type $type,
        protected bool $optional = false,
        protected ?string $helpText = null,
        protected mixed $default = null,
        protected ?string $placeholder = null,
    ) {}

    /**
     * @return array{display_name: string, name: string, type: string, optional?: bool, help_text?: string, default?: mixed, placeholder?: string}
     */
    public function toArray(): array
    {
        $array = [
            'display_name' => $this->displayName,
            'name' => $this->name,
            'type' => $this->type->value,
        ];

        if ($this->optional) {
            Arr::set($array, 'optional', $this->optional);
        }

        if ($this->helpText) {
            Arr::set($array, 'help_text', $this->helpText);
        }

        if (null !== $this->default) {
            Arr::set($array, 'default', (string) $this->default);
        }

        if ($this->placeholder) {
            Arr::set($array, 'placeholder', $this->placeholder);
        }

        return $array;
    }

    public function setDisplayName(string $displayName): Element
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function setName(string $name): Element
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): Element
    {
        $this->optional = $optional;

        return $this;
    }

    public function setHelpText(?string $helpText): Element
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function setDefault(mixed $default): Element
    {
        $this->default = $default;

        return $this;
    }

    public function setPlaceholder(?string $placeholder): Element
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}

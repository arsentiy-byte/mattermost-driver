<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog\Element;

use Arsentiyz\MattermostDriver\Entities\Dialog\Element;
use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Subtype;
use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Type;
use Illuminate\Support\Arr;

final class TextAreaElement extends Element
{
    public function __construct(
        string $displayName,
        string $name,
        private Subtype $subtype = Subtype::TEXT,
        private int $minLength = 0,
        private int $maxLength = 3000,
        bool $optional = false,
        ?string $helpText = null,
        mixed $default = null,
        ?string $placeholder = null,
    ) {
        parent::__construct(
            $displayName,
            $name,
            Type::TEXTAREA,
            $optional,
            $helpText,
            $default,
            $placeholder
        );
    }

    /**
     * @param array{display_name: string, name: string, subtype?: string, min_length?: int, max_length?: int, optional?: bool, help_text?: string, default?: mixed, placeholder?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            Subtype::from(Arr::get($array, 'subtype', Subtype::TEXT->value)),
            (int) Arr::get($array, 'min_length', 0),
            (int) Arr::get($array, 'max_length', 3000),
            (bool) Arr::get($array, 'optional', false),
            Arr::get($array, 'help_text'),
            Arr::get($array, 'default'),
            Arr::get($array, 'placeholder'),
        );
    }

    /**
     * @return array{display_name: string, name: string, subtype?: string, min_length?: int, max_length?: int, optional?: bool, help_text?: string, default?: mixed, placeholder?: string}
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'subtype' => $this->subtype->value,
            'min_length' => $this->minLength,
            'max_length' => $this->maxLength,
        ]);
    }

    public function setSubtype(Subtype $subtype): TextAreaElement
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function setMinLength(int $minLength): TextAreaElement
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function setMaxLength(int $maxLength): TextAreaElement
    {
        $this->maxLength = $maxLength;

        return $this;
    }
}

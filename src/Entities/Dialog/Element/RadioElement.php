<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog\Element;

use Arsentiyz\MattermostDriver\Collections\Dialog\Element\OptionCollection;
use Arsentiyz\MattermostDriver\Entities\Dialog\Element;
use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Type;
use Illuminate\Support\Arr;

final class RadioElement extends Element
{
    public function __construct(
        string $displayName,
        string $name,
        bool $optional = false,
        private ?OptionCollection $options = null,
        ?string $helpText = null,
        mixed $default = null,
        ?string $placeholder = null
    ) {
        parent::__construct(
            $displayName,
            $name,
            Type::RADIO,
            $optional,
            $helpText,
            $default,
            $placeholder
        );
    }

    /**
     * @param array{display_name: string, name: string, optional?: bool, options?: array<int, array{text: string, value: mixed}>, help_text?: string, default?: mixed, placeholder?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            (bool) Arr::get($array, 'optional', false),
            OptionCollection::make(Arr::get($array, 'options', [])),
            Arr::get($array, 'help_text'),
            Arr::get($array, 'default'),
            Arr::get($array, 'placeholder'),
        );
    }

    /**
     * @return array{display_name: string, name: string, type: string, optional?: bool, options?: array<int, array{text: string, value: mixed}>, help_text?: string, default?: mixed, placeholder?: string}
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'options' => $this->options?->toArray() ?? [],
        ]);
    }

    public function setOptions(?OptionCollection $options): RadioElement
    {
        $this->options = $options;

        return $this;
    }

    public function addOption(Option $option): RadioElement
    {
        if (null === $this->options) {
            $this->options = new OptionCollection();
        }

        $this->options->add($option);

        return $this;
    }
}

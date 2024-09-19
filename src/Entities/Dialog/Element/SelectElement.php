<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Dialog\Element;

use Arsentiyz\MattermostDriver\Collections\Dialog\Element\OptionCollection;
use Arsentiyz\MattermostDriver\Entities\Dialog\Element;
use Arsentiyz\MattermostDriver\Enums\Attachment\Action\DataSource;
use Arsentiyz\MattermostDriver\Enums\Dialog\Element\Type;
use Illuminate\Support\Arr;

final class SelectElement extends Element
{
    public function __construct(
        string $displayName,
        string $name,
        private ?DataSource $dataSource,
        bool $optional = false,
        private ?OptionCollection $options = null,
        ?string $helpText = null,
        mixed $default = null,
        ?string $placeholder = null
    ) {
        parent::__construct(
            $displayName,
            $name,
            Type::SELECT,
            $optional,
            $helpText,
            $default,
            $placeholder
        );
    }

    /**
     * @param array{display_name: string, name: string, data_source?: string, optional?: bool, options?: array<int, array{text: string, value: mixed}>, help_text?: string, default?: mixed, placeholder?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'display_name'),
            Arr::get($array, 'name'),
            DataSource::tryFrom(Arr::get($array, 'data_source', 'unknown')),
            (bool) Arr::get($array, 'optional', false),
            OptionCollection::make(Arr::get($array, 'options', [])),
            Arr::get($array, 'help_text'),
            Arr::get($array, 'default'),
            Arr::get($array, 'placeholder'),
        );
    }

    /**
     * @return array{display_name: string, name: string, data_source?: string, optional?: bool, options?: array<int, array{text: string, value: mixed}>, help_text?: string, default?: mixed, placeholder?: string}
     */
    public function toArray(): array
    {
        $array = [];

        if (null !== $this->dataSource && (null === $this->options || $this->options->isEmpty())) {
            Arr::set($array, 'data_source', $this->dataSource->value);
        }

        if (null !== $this->options && $this->options->isNotEmpty()) {
            Arr::set($array, 'options', $this->options->toArray());
        }

        return array_merge(parent::toArray(), $array);
    }

    public function setDataSource(?DataSource $dataSource): SelectElement
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    public function setOptions(?OptionCollection $options): SelectElement
    {
        $this->options = $options;

        return $this;
    }

    public function addOption(Option $option): SelectElement
    {
        if (null === $this->options) {
            $this->options = new OptionCollection();
        }

        $this->options->add($option);

        return $this;
    }
}

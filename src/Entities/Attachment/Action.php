<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Attachment;

use Arsentiyz\MattermostDriver\Entities\Attachment\Action\Integration;
use Arsentiyz\MattermostDriver\Enums\Attachment\Action\DataSource;
use Arsentiyz\MattermostDriver\Enums\Attachment\Action\Style;
use Arsentiyz\MattermostDriver\Enums\Attachment\Action\Type;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

final class Action implements Arrayable
{
    public function __construct(
        private string $name,
        private Integration $integration,
        private Style $style = Style::DEFAULT,
        private ?Type $type = null,
        private ?DataSource $dataSource = null,
        private ?string $id = null,
    ) {}

    /**
     * @param array{name: string, integration: array, style?: string, type?: string, data_source?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'name'),
            Integration::fromArray(Arr::get($array, 'integration')),
            Style::from(Arr::get($array, 'style', Style::DEFAULT->value)),
            self::getType(Arr::get($array, 'type')),
            self::getDataSource(Arr::get($array, 'data_source')),
            Arr::get($array, 'id'),
        );
    }

    /**
     * @return array{name: string, integration: array, style?: string, type?: string, data_source?: string}
     */
    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'integration' => $this->integration->toArray(),
            'style' => $this->style->value,
        ];

        if (null !== $this->type && null !== $this->dataSource) {
            Arr::set($array, 'type', $this->type->value);
            Arr::set($array, 'data_source', $this->dataSource->value);
        }

        if (!empty($this->id)) {
            Arr::set($array, 'id', $this->id);
        }

        return $array;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setIntegration(Integration $integration): self
    {
        $this->integration = $integration;

        return $this;
    }

    public function setStyle(Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function setType(Type $type, DataSource $dataSource): self
    {
        $this->type = $type;
        $this->dataSource = $dataSource;

        return $this;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withoutType(): self
    {
        $this->type = null;
        $this->dataSource = null;

        return $this;
    }

    private static function getType(?string $type): ?Type
    {
        if (empty($type)) {
            return null;
        }

        return Type::from($type);
    }

    private static function getDataSource(?string $dataSource): ?DataSource
    {
        if (empty($dataSource)) {
            return null;
        }

        return DataSource::from($dataSource);
    }
}

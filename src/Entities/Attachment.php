<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities;

use Arsentiyz\MattermostDriver\Collections\ActionCollection;
use Arsentiyz\MattermostDriver\Collections\FieldCollection;
use Arsentiyz\MattermostDriver\Entities\Attachment\Action;
use Arsentiyz\MattermostDriver\Entities\Attachment\Field;
use Illuminate\Support\Arr;

final class Attachment
{
    public function __construct(
        private ?string $fallback = null,
        private ?string $color = null,
        private ?string $pretext = null,
        private ?string $text = null,
        private ?string $authorName = null,
        private ?string $authorLink = null,
        private ?string $authorIcon = null,
        private ?string $title = null,
        private ?string $titleLink = null,
        private ?FieldCollection $fields = null,
        private ?ActionCollection $actions = null,
    ) {}

    /**
     * @param array{fallback?: string, color?: string, pretext?: string, text?: string, author_name?: string, author_link?: string, author_icon?: string, title?: string, title_link?: string, fields?: array, actions?: array} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'fallback'),
            Arr::get($array, 'color'),
            Arr::get($array, 'pretext'),
            Arr::get($array, 'text'),
            Arr::get($array, 'author_name'),
            Arr::get($array, 'author_link'),
            Arr::get($array, 'author_icon'),
            Arr::get($array, 'title'),
            Arr::get($array, 'title_link'),
            FieldCollection::make(Arr::get($array, 'fields', [])),
            ActionCollection::make(Arr::get($array, 'actions', [])),
        );
    }

    /**
     * @return array{fallback?: string, color?: string, pretext?: string, text?: string, author_name?: string, author_link?: string, author_icon?: string, title?: string, title_link?: string, fields?: array, actions?: array}
     */
    public function toArray(): array
    {
        $array = [];

        if (!empty($this->fallback)) {
            Arr::set($array, 'fallback', $this->fallback);
        }

        if (!empty($this->color)) {
            Arr::set($array, 'color', $this->color);
        }

        if (!empty($this->pretext)) {
            Arr::set($array, 'pretext', $this->pretext);
        }

        if (!empty($this->text)) {
            Arr::set($array, 'text', $this->text);
        }

        if (!empty($this->authorName)) {
            Arr::set($array, 'author_name', $this->authorName);
        }

        if (!empty($this->authorLink)) {
            Arr::set($array, 'author_link', $this->authorLink);
        }

        if (!empty($this->authorIcon)) {
            Arr::set($array, 'author_icon', $this->authorIcon);
        }

        if (!empty($this->title)) {
            Arr::set($array, 'title', $this->title);
        }

        if (!empty($this->titleLink)) {
            Arr::set($array, 'title_link', $this->titleLink);
        }

        if (null !== $this->fields && $this->fields->isNotEmpty()) {
            Arr::set($array, 'fields', $this->fields->toArray());
        }

        if (null !== $this->actions && $this->actions->isNotEmpty()) {
            Arr::set($array, 'actions', $this->actions->toArray());
        }

        return $array;
    }

    public function setFallback(?string $fallback): self
    {
        $this->fallback = $fallback;

        return $this;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function setPretext(?string $pretext): self
    {
        $this->pretext = $pretext;

        return $this;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function setAuthorLink(?string $authorLink): self
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    public function setAuthorIcon(?string $authorIcon): self
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setTitleLink(?string $titleLink): self
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    public function setFields(?FieldCollection $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function setActions(?ActionCollection $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function addAction(Action $action): self
    {
        $this->actions->add($action);

        return $this;
    }

    public function addField(Field $field): self
    {
        $this->fields->add($field);

        return $this;
    }

    public function clearFields(): self
    {
        $this->setFields(FieldCollection::make());

        return $this;
    }

    public function clearActions(): self
    {
        $this->setActions(ActionCollection::make());

        return $this;
    }
}

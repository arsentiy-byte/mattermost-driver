<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities;

use Arsentiyz\MattermostDriver\Entities\Dialog\Element;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

final class Dialog implements Arrayable
{
    /**
     * @param array<int, Element> $elements
     */
    public function __construct(
        private string $title,
        private array $elements,
        private ?string $callbackId = null,
        private ?string $introductionText = null,
        private ?string $iconUrl = null,
        private ?string $submitLabel = null,
        private bool $notifyOnCancel = false,
        private ?string $state = null,
    ) {}

    /**
     * @param array{title: string, elements: array<int, Element>, callback_id: string, introduction_text: string, icon_url?: string, submit_label?: string, notify_on_cancel?: bool, state?: string} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'title'),
            Arr::get($array, 'elements'),
            Arr::get($array, 'callback_id'),
            Arr::get($array, 'introduction_text'),
            Arr::get($array, 'icon_url'),
            Arr::get($array, 'submit_label'),
            (bool) Arr::get($array, 'notify_on_cancel', false),
            Arr::get($array, 'state'),
        );
    }

    /**
     * @return array{title: string, introduction_text: string, elements?: array<int, array<string, mixed>>, icon_url?: string, submit_label?: string, notify_on_cancel?: bool, state?: string}
     */
    public function toArray(): array
    {
        $array = [
            'title' => $this->title,
            'elements' => array_map(static fn (Element $element) => $element->toArray(), $this->elements),
        ];

        if (null !== $this->callbackId) {
            Arr::set($array, 'callback_id', $this->callbackId);
        }

        if (null !== $this->introductionText) {
            Arr::set($array, 'introduction_text', $this->introductionText);
        }

        if (null !== $this->iconUrl) {
            Arr::set($array, 'icon_url', $this->iconUrl);
        }

        if (null !== $this->submitLabel) {
            Arr::set($array, 'submit_label', $this->submitLabel);
        }

        if ($this->notifyOnCancel) {
            Arr::set($array, 'notify_on_cancel', $this->notifyOnCancel);
        }

        if (null !== $this->state) {
            Arr::set($array, 'state', $this->state);
        }

        return $array;
    }

    public function setTitle(string $title): Dialog
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param array<int, Element> $elements
     */
    public function setElements(array $elements): Dialog
    {
        $this->elements = $elements;

        return $this;
    }

    public function setCallbackId(?string $callbackId): Dialog
    {
        $this->callbackId = $callbackId;

        return $this;
    }

    public function setIntroductionText(?string $introductionText): Dialog
    {
        $this->introductionText = $introductionText;

        return $this;
    }

    public function setIconUrl(?string $iconUrl): Dialog
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    public function setSubmitLabel(?string $submitLabel): Dialog
    {
        $this->submitLabel = $submitLabel;

        return $this;
    }

    public function setNotifyOnCancel(bool $notifyOnCancel): Dialog
    {
        $this->notifyOnCancel = $notifyOnCancel;

        return $this;
    }

    public function setState(?string $state): Dialog
    {
        $this->state = $state;

        return $this;
    }

    public function addElement(Element $element): Dialog
    {
        $this->elements[] = $element;

        return $this;
    }
}

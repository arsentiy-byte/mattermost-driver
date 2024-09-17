<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Entities\Attachment\Action;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

final class Integration implements Arrayable
{
    public function __construct(
        private string $url,
        private array $context,
    ) {}

    /**
     * @param array{url: string, context?: array} $array
     */
    public static function fromArray(array $array): self
    {
        return new self(
            Arr::get($array, 'url'),
            Arr::get($array, 'context', []),
        );
    }

    /**
     * @return array{url: string, context?: array}
     */
    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'context' => $this->context,
        ];
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setContext(array $context): self
    {
        $this->context = $context;

        return $this;
    }
}

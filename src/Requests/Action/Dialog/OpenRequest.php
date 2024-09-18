<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Requests\Action\Dialog;

use Arsentiyz\MattermostDriver\Entities\Dialog;

final readonly class OpenRequest
{
    public function __construct(
        public string $triggerId,
        public string $url,
        public Dialog $dialog,
    ) {}

    /**
     * @return array{trigger_id: string, url: string, dialog: array<string, mixed>}
     */
    public function payload(): array
    {
        return [
            'trigger_id' => $this->triggerId,
            'url' => $this->url,
            'dialog' => $this->dialog->toArray(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\DTO;

use Arsentiyz\MattermostDriver\Collections\AttachmentCollection;
use Arsentiyz\MattermostDriver\Enums\Command\ResponseType;
use Illuminate\Support\Arr;

final readonly class CommandResponseDTO
{
    /**
     * @param array<int, self> $extraResponses
     */
    public function __construct(
        public ?string $text = null,
        public ?string $channelId = null,
        public ResponseType $responseType = ResponseType::EPHEMERAL,
        public ?string $username = null,
        public ?string $iconUrl = null,
        public ?AttachmentCollection $attachments = null,
        public ?string $goToLocation = null,
        public ?string $type = null,
        public ?array $extraResponses = null,
        public ?bool $skipSlackParsing = null,
        public ?array $props = null,
    ) {}

    public function map(bool $isExtraResponse = false): array
    {
        $this->validate();

        $array = [
            'response_type' => $this->responseType->value,
        ];

        if (!empty($this->text)) {
            Arr::set($array, 'text', $this->text);
        }

        if (!empty($this->channelId)) {
            Arr::set($array, 'channel_id', $this->channelId);
        }

        if (null !== $this->attachments && $this->attachments->isNotEmpty()) {
            Arr::set($array, 'attachments', $this->attachments->toArray());
        }

        if (!empty($this->username)) {
            Arr::set($array, 'username', $this->username);
        }

        if (!empty($this->iconUrl)) {
            Arr::set($array, 'icon_url', $this->iconUrl);
        }

        if (!empty($this->goToLocation) && false === $isExtraResponse) {
            Arr::set($array, 'go_to_location', $this->goToLocation);
        }

        if (!empty($this->type)) {
            Arr::set($array, 'type', $this->type);
        }

        if (!empty($this->extraResponses) && false === $isExtraResponse) {
            Arr::set($array, 'extra_responses', $this->mapExtraResponses());
        }

        if (!empty($this->skipSlackParsing)) {
            Arr::set($array, 'skip_slack_parsing', $this->skipSlackParsing);
        }

        if (!empty($this->props)) {
            Arr::set($array, 'props', $this->props);
        }

        return $array;
    }

    private function validate(): void
    {
        if (empty($this->channelId) && $this->isChannelIdRequired()) {
            throw new \InvalidArgumentException('Channel ID is required, when response type is IN_CHANNEL');
        }

        if (empty($this->text) && (null === $this->attachments || $this->attachments->isEmpty())) {
            throw new \InvalidArgumentException('Text or attachments are required');
        }
    }

    private function isChannelIdRequired(): bool
    {
        return ResponseType::IN_CHANNEL === $this->responseType;
    }

    private function mapExtraResponses(): array
    {
        return Arr::map($this->extraResponses, static fn (self $response): array => $response->map(true));
    }
}

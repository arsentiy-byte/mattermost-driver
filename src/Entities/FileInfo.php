<?php

declare(strict_types=1);

/**
 * This Driver is a PHP implementation of the official Mattermost Web Services API.
 * It allows developers to interact with the API by following the directives
 * outlined in the official documentation.
 *
 * @author Arsentiy Zhunussov <arsentiy.zhunussov@gmail.com>
 *
 * @see https://api.mattermost.com/
 */

namespace Arsentiyz\MattermostDriver\Entities;

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

final readonly class FileInfo
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $postId,
        public ?CarbonImmutable $createAt,
        public ?CarbonImmutable $updateAt,
        public ?CarbonImmutable $deleteAt,
        public string $name,
        public string $extension,
        public int $size,
        public string $mimeType,
        public int $width,
        public int $height,
        public bool $hasPreviewImage,
    ) {}

    public static function fromArray(array $array): self
    {
        $createAt = (int) Arr::get($array, 'create_at', 0);
        $updateAt = (int) Arr::get($array, 'update_at', 0);
        $deleteAt = (int) Arr::get($array, 'delete_at', 0);

        return new self(
            Arr::get($array, 'id'),
            Arr::get($array, 'user_id'),
            Arr::get($array, 'post_id'),
            0 !== $createAt ? CarbonImmutable::parse($createAt) : null,
            0 !== $updateAt ? CarbonImmutable::parse($updateAt) : null,
            0 !== $deleteAt ? CarbonImmutable::parse($deleteAt) : null,
            Arr::get($array, 'name'),
            Arr::get($array, 'extension'),
            (int) Arr::get($array, 'size'),
            Arr::get($array, 'mime_type'),
            (int) Arr::get($array, 'width'),
            (int) Arr::get($array, 'height'),
            (bool) Arr::get($array, 'has_preview_image'),
        );
    }

    /**
     * @return array<int, self>
     */
    public static function make(array $files): array
    {
        return Arr::map($files, static fn (array $file) => self::fromArray($file));
    }
}

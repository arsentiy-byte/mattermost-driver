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

namespace Arsentiyz\MattermostDriver\Responses\Command;

use Arsentiyz\MattermostDriver\Responses\Response;

final class DeleteResponse extends Response
{
    public function isSuccess(): bool
    {
        return parent::isSuccess() && 'OK' === $this->body('status');
    }

    public function isFailed(): bool
    {
        return parent::isFailed() || 'OK' !== $this->body('status');
    }
}

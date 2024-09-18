<?php

declare(strict_types=1);

namespace Arsentiyz\MattermostDriver\Responses\Action\Dialog;

use Arsentiyz\MattermostDriver\Responses\Response;

final class OpenResponse extends Response
{
    public function getDialogStatus(): string
    {
        return $this->body('status');
    }
}

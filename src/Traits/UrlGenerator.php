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

namespace Arsentiyz\MattermostDriver\Traits;

use Illuminate\Support\Facades\URL;

trait UrlGenerator
{
    public function query(string $uri, array $query = []): string
    {
        return URL::query($uri, $query);
    }
}

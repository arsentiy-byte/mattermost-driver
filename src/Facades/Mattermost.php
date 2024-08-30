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

namespace Arsentiyz\MattermostDriver\Facades;

use Arsentiyz\MattermostDriver\Driver;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Driver server(string|null $name = null)
 *
 * @mixin \Arsentiyz\MattermostDriver\Mattermost
 */
final class Mattermost extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mattermost';
    }
}

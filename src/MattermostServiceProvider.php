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

namespace Arsentiyz\MattermostDriver;

use Arsentiyz\MattermostDriver\Contracts\DriverContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class MattermostServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/mattermost.php' => config_path('mattermost.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/mattermost.php',
            'mattermost'
        );

        $this->app->singleton('mattermost', function (Application $app) {
            return new Mattermost($app);
        });

        $this->app->singleton(DriverContract::class, function (Application $app) {
            return $app['mattermost']->server();
        });
    }
}

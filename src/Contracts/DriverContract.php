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

namespace Arsentiyz\MattermostDriver\Contracts;

use Arsentiyz\MattermostDriver\Endpoints\ChannelEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\CommandEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\DialogEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\PostEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\TeamEndpoint;
use Arsentiyz\MattermostDriver\Endpoints\UserEndpoint;
use Arsentiyz\MattermostDriver\Responses\User\MeResponse;

interface DriverContract
{
    public function authenticate(): MeResponse;

    public function getUserEndpoint(): UserEndpoint;

    public function getPostEndpoint(): PostEndpoint;

    public function getTeamEndpoint(): TeamEndpoint;

    public function getCommandEndpoint(): CommandEndpoint;

    public function getChannelEndpoint(): ChannelEndpoint;

    public function getDialogEndpoint(): DialogEndpoint;
}

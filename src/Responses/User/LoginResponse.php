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

namespace Arsentiyz\MattermostDriver\Responses\User;

use Arsentiyz\MattermostDriver\Entities\User;
use Arsentiyz\MattermostDriver\Responses\Response;
use Illuminate\Support\Arr;

final class LoginResponse extends Response
{
    public function makeMeResponse(): MeResponse
    {
        return new MeResponse($this->response);
    }

    public function getToken(): ?string
    {
        $token = explode(',', $this->header('Token'));

        return Arr::get($token, 0);
    }

    public function getUser(): ?User
    {
        if ($this->isFailed()) {
            return null;
        }

        return User::fromArray($this->getBody());
    }
}

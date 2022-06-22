<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:43
 */

namespace HughCube\Laravel\HuaWei\Services\Account;

use HughCube\Laravel\HuaWei\Application;
use HughCube\Laravel\HuaWei\Container;
use HughCube\Laravel\HuaWei\Services\Account\Apis\GetTokenRequest;
use HughCube\Laravel\HuaWei\Services\Account\Apis\RefreshTokenRequest;
use HughCube\Laravel\HuaWei\Services\Account\Apis\TokenInfoRequest;

/**
 * @mixin Application
 * @see
 */
class Service extends Container
{
    public function getHttpBaseUri(): string
    {
        return 'https://oauth-login.cloud.huawei.com';
    }

    public function createGetTokenRequest(): GetTokenRequest
    {
        return new GetTokenRequest($this);
    }

    public function createRefreshTokenRequest(): RefreshTokenRequest
    {
        return new RefreshTokenRequest($this);
    }

    public function createTokenInfoRequest(): TokenInfoRequest
    {
        return new TokenInfoRequest($this);
    }
}

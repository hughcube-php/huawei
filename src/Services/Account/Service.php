<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:43.
 */

namespace HughCube\Laravel\HuaWei\Services\Account;

use HughCube\Laravel\HuaWei\Client;
use HughCube\Laravel\HuaWei\Services\Account\Apis\GetTokenRequest;
use HughCube\Laravel\HuaWei\Services\Account\Apis\RefreshTokenRequest;
use HughCube\Laravel\HuaWei\Services\Account\Apis\TokenInfoRequest;

/**
 * @mixin Client
 *
 * @see
 */
class Service extends \HughCube\Laravel\HuaWei\Service
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

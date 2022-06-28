<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:43.
 */

namespace HughCube\Laravel\HuaWei\Services\AppAt;

use HughCube\Laravel\HuaWei\Client;
use HughCube\Laravel\HuaWei\Services\AppAt\Apis\GetClientCredentialsRequest;

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

    protected function createGetClientCredentialsRequest(): GetClientCredentialsRequest
    {
        return new GetClientCredentialsRequest($this);
    }

    public function getHttpAuthorization(): string
    {
        $response = $this->createGetClientCredentialsRequest()->request();

        $auth = sprintf('APPAT:%s', $response->access_token);

        return 'Basic '.base64_encode(utf8_encode($auth));
    }
}

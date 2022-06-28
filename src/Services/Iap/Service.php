<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:43.
 */

namespace HughCube\Laravel\HuaWei\Services\Iap;

use HughCube\Laravel\HuaWei\Client;
use HughCube\Laravel\HuaWei\Services\Iap\Apis\OrderConfirmRequest;
use HughCube\Laravel\HuaWei\Services\Iap\Apis\OrderVerifyTokenRequest;

/**
 * @mixin Client
 *
 * @see
 */
class Service extends \HughCube\Laravel\HuaWei\Service
{
    public function getHttpBaseUri(): string
    {
        return 'https://orders-drcn.iap.hicloud.com';
    }

    public function createOrderVerifyTokenRequest(): OrderVerifyTokenRequest
    {
        return new OrderVerifyTokenRequest($this);
    }

    public function createOrderConfirmRequest(): OrderConfirmRequest
    {
        return new OrderConfirmRequest($this);
    }
}

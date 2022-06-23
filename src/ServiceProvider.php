<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:32 下午.
 */

namespace HughCube\Laravel\HuaWei;

use HughCube\Laravel\ServiceSupport\ServiceProvider as ServiceSupportServiceProvider;

class ServiceProvider extends ServiceSupportServiceProvider
{
    /**
     * @inheritDoc
     */
    protected function getFacadeAccessor(): string
    {
        return HuaWei::getFacadeAccessor();
    }

    /**
     * @inheritDoc
     */
    protected function createFacadeRoot($app): Manager
    {
        return new Manager();
    }
}

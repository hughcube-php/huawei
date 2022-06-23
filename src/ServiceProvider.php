<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:32 下午.
 */

namespace HughCube\Laravel\HuaWei;

class ServiceProvider extends \HughCube\Laravel\ServiceSupport\ServiceProvider
{
    protected function getPackageFacadeAccessor(): string
    {
        return HuaWei::getFacadeAccessor();
    }

    protected function createPackageFacadeRoot($app): Manager
    {
        return new Manager();
    }
}

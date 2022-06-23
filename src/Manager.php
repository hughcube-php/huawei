<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:19 下午.
 */

namespace HughCube\Laravel\HuaWei;

use HughCube\Laravel\ServiceSupport\Manager as ServiceSupportManager;

class Manager extends ServiceSupportManager
{
    public function getDriversConfigKey(): string
    {
        return 'clients';
    }

    protected function makeDriver(array $config): Client
    {
        return new Client($config);
    }

    protected function getPackageFacadeAccessor(): string
    {
        return HuaWei::getFacadeAccessor();
    }
}

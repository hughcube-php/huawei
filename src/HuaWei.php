<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:31 下午.
 */

namespace HughCube\Laravel\HuaWei;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * Class Package.
 *
 * @method static Client client(string $name = null)
 * @method static Services\Account\Service account()
 *
 * @see \HughCube\Laravel\HuaWei\Manager
 * @see \HughCube\Laravel\HuaWei\ServiceProvider
 */
class HuaWei extends IlluminateFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'huawei';
    }
}

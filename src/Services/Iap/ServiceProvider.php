<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 11:31.
 */

namespace HughCube\Laravel\HuaWei\Services\Iap;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple->offsetSet('iap', function ($pimple) {
            return new Service($pimple);
        });
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 11:16.
 */

namespace HughCube\Laravel\HuaWei\Cache;

use Illuminate\Support\Facades\Cache;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['cache'] = function ($app) {
            return Cache::store($app->config->get('cache'));
        };
    }
}

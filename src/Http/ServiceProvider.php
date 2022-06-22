<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 11:16.
 */

namespace HughCube\Laravel\HuaWei\Http;

use HughCube\GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['http_client'] = function ($app) {
            return new Client($app['config']->get('http', []));
        };
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:58
 */

namespace HughCube\Laravel\HuaWei;

use HughCube\GuzzleHttp\Client;
use HughCube\Laravel\HuaWei\Providers\ConfigServiceProvider;
use HughCube\Laravel\HuaWei\Providers\HttpClientServiceProvider;

/**
 * @property Config $config
 * @property Client $http_client
 * @property Services\Account\Service $account
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        \HughCube\Laravel\HuaWei\Services\Account\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * Constructor.
     *
     * @param  array  $config
     * @param  array  $prepends
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        $this->registerProviders($this->getProviders());

        parent::__construct($prepends);

        $this->userConfig = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return array_replace_recursive($this->defaultConfig, $this->userConfig);
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders(): array
    {
        return array_merge([
            ConfigServiceProvider::class,
            HttpClientServiceProvider::class,
        ], $this->providers);
    }

    /**
     * @param  array  $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}

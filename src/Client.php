<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 10:58
 */

namespace HughCube\Laravel\HuaWei;

use GuzzleHttp\RequestOptions;
use HughCube\GuzzleHttp\Client as HttpClient;
use HughCube\Laravel\HuaWei\Config\Config;
use HughCube\Laravel\HuaWei\Support\Container;

/**
 * @property Config $config
 * @property HttpClient $http_client
 * @property Services\Account\Service $account
 */
class Client extends Container
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
    protected $defaultConfig = [
        'http' => [
            RequestOptions::HTTP_ERRORS => false,
        ]
    ];

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
            \HughCube\Laravel\HuaWei\Config\ServiceProvider::class,
            \HughCube\Laravel\HuaWei\Http\ServiceProvider::class,
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

    public function account(): Services\Account\Service
    {
        return $this->account;
    }
}

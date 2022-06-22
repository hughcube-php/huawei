<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 19:55
 */

namespace HughCube\Laravel\HuaWei;

/**
 * @mixin Client
 */
class Service
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __get($name)
    {
        return $this->client->{$name};
    }

    public function __set($name, $value)
    {
        $this->client->{$name} = $value;
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }
}

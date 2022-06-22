<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 14:31.
 */

namespace HughCube\Laravel\HuaWei\Support;

class Container extends \Pimple\Container
{
    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get(string $id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set(string $id, $value)
    {
        $this->offsetSet($id, $value);
    }

    public function toArray(): array
    {
        $values = [];
        foreach ($this->keys() as $key) {
            $values[$key] = $this->offsetGet($key);
        }

        return $values;
    }
}

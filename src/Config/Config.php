<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 11:14.
 */

namespace HughCube\Laravel\HuaWei\Config;

use ArrayIterator;

class Config
{
    /**
     * The collection data.
     *
     * @var array
     */
    protected $items = [];

    /**
     * set data.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Return all items.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Merge data.
     *
     * @param iterable $items
     *
     * @return static
     */
    public function merge(iterable $items): Config
    {
        /** @phpstan-ignore-next-line */
        $clone = new static($this->all());

        foreach ($items as $key => $value) {
            $clone->set($key, $value);
        }

        return $clone;
    }

    /**
     * To determine Whether the specified element exists.
     *
     * @param int|string $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Retrieve the first item.
     *
     * @return mixed
     */
    public function first()
    {
        return reset($this->items);
    }

    /**
     * Retrieve the last item.
     *
     * @return bool
     */
    public function last(): bool
    {
        $end = end($this->items);

        reset($this->items);

        return $end;
    }

    /**
     * add the item value.
     *
     * @param int|string $key
     * @param mixed      $value
     */
    public function add($key, $value)
    {
        if (!$this->has($key)) {
            $this->set($key, $value);
        }
    }

    /**
     * Set the item value.
     *
     * @param int|string $key
     * @param mixed      $value
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    /**
     * Retrieve item from Collection.
     *
     * @param int|string $key
     * @param mixed      $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->items[$key];
    }

    /**
     * Remove item form Collection.
     *
     * @param int|string $key
     */
    public function forget($key)
    {
        unset($this->items[$key]);
    }

    /**
     * Build to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->all();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator.
     *
     * @see http://php.net/manual/en/iteratoraggregate.getiterator.php
     *
     * @return ArrayIterator An instance of an object implementing <b>Iterator</b> or
     *                       <b>Traversable</b>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object.
     *
     * @see http://php.net/manual/en/countable.count.php
     *
     * @return int the custom count as an integer.
     *             </p>
     *             <p>
     *             The return value is cast to an integer
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get a data by key.
     *
     * @param int|string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Assigns a value to the specified data.
     *
     * @param int|string $key
     * @param mixed      $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Whether or not an data exists by key.
     *
     * @param int|string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * Unset an data by key.
     *
     * @param int|string $key
     */
    public function __unset($key)
    {
        $this->forget($key);
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            $this->forget($offset);
        }
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->get($offset) : null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }
}

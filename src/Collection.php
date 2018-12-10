<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 06.12.2018
 * Time: 20:12
 */

namespace App;


class Collection implements \Iterator, \ArrayAccess
{
    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    private $items;

    public function __construct()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->items[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->items as $key => $item) {
            $result[$key] = $item->asArray();
        }
        return $result;
    }
}
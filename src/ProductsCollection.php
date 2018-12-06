<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 06.12.2018
 * Time: 20:36
 */

namespace App;


class ProductsCollection extends Collection
{
    public function current(): ?Product
    {
        return parent::current();
    }

    public function offsetGet($offset): ?Product
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof Product) {
            throw new \Exception('value must be instance of ' . Product::class);
        }
        parent::offsetSet($offset, $value);
    }
}
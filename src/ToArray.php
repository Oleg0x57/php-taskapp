<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.11.2018
 * Time: 23:04
 */

namespace App;


trait ToArray
{
    public function asArray()
    {
        $result = [];
        foreach ($this as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }
}
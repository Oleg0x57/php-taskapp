<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 13.01.2019
 * Time: 15:06
 */

namespace App;


class BasketApiController
{
    /**
     * @var BasketService
     */
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
}
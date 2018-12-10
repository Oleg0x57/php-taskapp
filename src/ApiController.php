<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 03.12.2018
 * Time: 21:56
 */

namespace App;


class ApiController
{
    /**
     * @var \App\ProductService
     */
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function view($id)
    {
        return $this->service->one($id);
    }
}
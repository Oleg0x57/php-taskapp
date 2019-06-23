<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 03.12.2018
 * Time: 21:28
 */

namespace App;

class ProductController
{
    /**
     * @var \App\ProductService
     */
    private $service;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct($service, $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }

    public function index()
    {
        $products = $this->service->list();
        return $this->twig->render('index.html', ['products' => $products]);
    }

    public function view($id)
    {
        $product = $this->service->one($id);
        return $this->twig->render('view.html', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = $this->service->one($id);
        return $this->twig->render('edit.html', ['product' => $product]);
    }
}
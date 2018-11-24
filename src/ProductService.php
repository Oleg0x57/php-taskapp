<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.11.2018
 * Time: 22:36
 */

namespace App;

class ProductService
{
    /**
     * @var ProductsRepositoryInterface
     */
    private $repository;

    public function __construct(ProductsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function view(int $id)
    {
        return $this->repository->getById($id)->asArray();
    }

    public function list()
    {
        $products = $this->repository->getList();
        $result = [];
        foreach ($products as $product) {
            $result[] = $product->asArray();
        }
        return $result;
    }

    public function delete(int $id)
    {

    }
}
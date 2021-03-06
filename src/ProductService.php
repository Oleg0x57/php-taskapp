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

    public function create($data)
    {
        $product = new Product(null, $data['title'], $data['package'], $data['bestBefore'], $data['measure'], $data['volume'], $data['cost']);
        if ($this->repository->create($product)) {
            $result = $this->repository->getList()->toArray();
        } else {
            $result = ['error' => true];
        }
        return $result;
    }

    public function update($data)
    {
        $product = new Product($data['id'], $data['title'], $data['package'], $data['bestBefore'], $data['measure'], $data['volume'], $data['cost']);
        if ($this->repository->update($product)) {
            $result = $this->repository->getList()->toArray();
        } else {
            $result = ['error' => true];
        }
        return $result;
    }

    public function one(int $id)
    {
        return $this->repository->getById($id)->asArray();
    }

    public function list()
    {
        return $this->repository->getList()->toArray();
    }

    public function delete(int $id)
    {

    }
}
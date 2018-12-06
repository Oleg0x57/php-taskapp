<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.11.2018
 * Time: 22:40
 */

namespace App;


interface ProductsRepositoryInterface
{
    /**
     * @param Product $product
     * @return bool
     */
    public function create(Product $product);

    /**
     * @return ProductsCollection
     */
    public function getList();

    /**
     * @param int $id
     * @return Product
     */
    public function getById(int $id);

    /**
     * @param Product $product
     * @return bool
     */
    public function update(Product $product);

    /**
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product);
}
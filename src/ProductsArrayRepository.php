<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.11.2018
 * Time: 22:08
 */

namespace App;

/**
 * Class ProductsRepository
 * @package App
 */
class ProductsArrayRepository implements ProductsRepositoryInterface
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * ProductsRepository constructor.
     */
    public function __construct()
    {
        $this->data = require 'data.php';
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function create(Product $product)
    {
        $product->setId(count($this->data));
        $this->data[] = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'package' => $product->getPackage(),
            'bestBefore' => $product->getBestBefore(),
            'measure' => $product->getMeasure(),
            'volume' => $product->getVolume(),
            'cost' => $product->getCost(),
        ];
        return true;
    }

    /**
     * @return ProductsCollection
     */
    public function getList()
    {
        $products = new ProductsCollection();
        foreach ($this->data as $key => $item) {
            $products[] = new Product($item['id'], $item['title'], $item['package'], $item['bestBefore'], $item['measure'], $item['volume'], $item['cost']);
        }
        return $products;
    }

    public function getById(int $id)
    {
        foreach ($this->data as $key => $item) {
            if ($item['id'] === $id) {
                return new Product($item['id'], $item['title'], $item['package'], $item['bestBefore'], $item['measure'], $item['volume'], $item['cost']);
            }
        }
        throw new \Exception('Item not found!');
    }

    /**
     * @param Product $product
     * @return bool
     * @throws \Exception
     */
    public function update(Product $product)
    {
        foreach ($this->data as $key => $item) {
            if ($item['id'] === $product->getId()) {
                $this->data[$key] = [
                    'id' => $product->getId(),
                    'title' => $product->getTitle(),
                    'package' => $product->getPackage(),
                    'bestBefore' => $product->getBestBefore(),
                    'measure' => $product->getMeasure(),
                    'volume' => $product->getVolume(),
                    'cost' => $product->getCost(),
                ];
                return true;
            }
        }
        throw new \Exception('Item not found!');
    }

    /**
     * @param Product $product
     * @return bool
     * @throws \Exception
     */
    public function delete(Product $product)
    {
        foreach ($this->data as $key => $item) {
            if ($item['id'] === $product->getId()) {
                unset($this->data[$key]);
                return true;
            }
        }
        throw new \Exception('Item not found!');
    }
}
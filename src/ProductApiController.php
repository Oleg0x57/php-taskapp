<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 13.01.2019
 * Time: 10:17
 */

namespace App;


class ProductApiController
{
    /**
     * @var ProductService
     */
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function respond($method, $id, $params)
    {
        if (isset($id)) {
            switch ($method) {
                case 'GET':
                    $result = $this->service->one($id);
                    break;
                case'PUT':
                    if (empty($params['id'])) {
                        $params['id'] = $id;
                    }
                    $result = $this->service->update($params);
                    break;
                case 'DELETE':
                    $result = $this->service->delete($id);
                    break;
                default:
                    $result = null;
                    break;
            }
        } else {
            switch ($method) {
                case 'GET':
                    $result = $this->service->list();
                    break;
                case'POST':
                    $result = $this->service->create($params);
                    break;
                default:
                    $result = null;
                    break;
            }
        }
        return $result;
    }
}
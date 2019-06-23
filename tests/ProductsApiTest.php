<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 12.01.2019
 * Time: 19:14
 */

class ProductsApiTest extends \PHPUnit\Framework\TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $products;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080']);
        $this->products = require dirname(__DIR__) . '/src/data.php';
    }

    public function testProductsGet()
    {
        $response = $this->client->get('/api/v1/products');
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertEquals('application/json', $response->getHeader('Content-Type')[0]);
        $this->assertEquals($this->products, json_decode((string)$response->getBody(), true));
    }

    public function testProductsPost()
    {
        $response = $this->client->post('/api/v1/products', ['form_params' => [
            'title' => 'test',
            'package' => 'box',
            'bestBefore' => 3,
            'measure' => 'kg',
            'volume' => 2,
            'cost' => 123,
        ]]);
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', json_decode((string)$response->getBody(), true)['message']);
    }

    public function testConcreteProductGet()
    {
        $response = $this->client->get('/api/v1/products/1');
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals($this->products[0], json_decode((string)$response->getBody(), true));
    }

    public function testConcreteProductPut()
    {
        $response = $this->client->put('/api/v1/products/1', ['form_params' => [
            'title' => 'test',
            'package' => 'box',
            'bestBefore' => 3,
            'measure' => 'kg',
            'volume' => 2,
            'cost' => 123,
        ]]);
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', json_decode((string)$response->getBody(), true)['message']);
    }

    public function testConcreteProductDelete()
    {
        $response = $this->client->delete('/api/v1/products/1');
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', json_decode((string)$response->getBody(), true)['message']);
    }

    public function tearDown()
    {
        $this->client = null;
        $this->products = null;
    }
}
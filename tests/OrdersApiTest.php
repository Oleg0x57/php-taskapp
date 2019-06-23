<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 13.01.2019
 * Time: 15:13
 */

class OrdersApiTest extends \PHPUnit\Framework\TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080']);
    }

    public function tearDown()
    {
        $this->client = null;
    }

    public function testOrdersGet()
    {
        $response = $this->client->get('/api/v1/orders');
        $this->assertEquals('200', $response->getStatusCode());
    }

    public function testOrdersPost()
    {
        $response = $this->client->get('/api/v1/orders', ['form_params' => [
        ]]);
        $this->assertEquals('200', $response->getStatusCode());
    }
}
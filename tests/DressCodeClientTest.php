<?php

namespace tests;

use Padosoft\DressCodeApi\DressCodeClient;
use Padosoft\DressCodeApi\DressCodeKey;

class DressCodeClientTest extends \PHPUnit\Framework\TestCase
{
    private $client;

    protected function setUp(): void
    {
        $key = new DressCodeKey('client_key', 'channel_key');
        $this->client = DressCodeClient::create($key);
    }

    public function testMakeRequestReturnsArray()
    {
        $response = $this->client->makeRequest('GET', 'new_item_sold', ['productID' => '123']);
        $this->assertIsArray($response);
    }

    public function testMakeRequestReturnsExpectedData()
    {
        $response = $this->client->makeRequest('GET', 'new_item_sold', ['productID' => '123']);
        $this->assertEquals('Example Product', $response['name']);
        $this->assertEquals('An example product description', $response['description']);
        $this->assertEquals(10.99, $response['price']);
    }

    public function testPathReplacesParams()
    {
        $params = ['client' => 'client_key', 'channelKey' => 'channel_key', 'productID' => '123'];
        $path = $this->client->path('new_item_sold', $params);
        $this->assertEquals('feeds/en/clients/client_key/orders/items?channelKey=channel_key', $path);
    }

    public function testEndpointsReturnsCorrectPath()
    {
        $path = DressCodeClient::endpoints('new_item_sold');
        $this->assertEquals('feeds/en/clients/{client}/orders/items?channelKey={channelKey}', $path);
    }
}
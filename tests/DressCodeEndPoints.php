<?php

namespace tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Padosoft\DressCodeApi\DressCodeEndPoints;

class DressCodeEndPointsTest extends TestCase
{
    public function testGetAllEndPointsReturnsArray()
    {
        $endPoints = new DressCodeEndPoints('get');
        $this->assertIsArray($endPoints->getAllEndPoints());
    }

    public function testEndPointReturnsValidUrl()
    {
        $params = [
            'client' => '123',
            'channelKey' => 'abc',
            'productID' => '456',
        ];
        $endPoints = DressCodeEndPoints::get('get', $params);
        $url = $endPoints->endPoint('get.new_item_sold');
        $expectedUrl = 'https://api.dresscode.cloud/channels/v2/api/feeds/en/clients/123/products/456?channelKey=abc';
        $this->assertEquals($expectedUrl, $url);
    }

    public function testEndPointThrowsExceptionForInvalidEndpoint()
    {
        echo('o');
        $params = [
            'client' => '123',
            'channelKey' => 'abc',
            'productID' => '456',
        ];
        $endPoints = DressCodeEndPoints::get('get', $params);
        $this->expectException(Exception::class);
        $endPoints->endPoint('get.invalid_endpoint');
    }
}
<?php
namespace Padosoft\DressCodeApi;
use Exception;

class DressCodeEndPoints
{
    //costant url base
    const BASE_URL = 'https://api.dresscode.cloud/channels/v2/api/';
    //configurazione endpoint
    const END_POINTS = [
        'post'=>[
            'new_item_sold' => 'feeds/en/clients/{client}/orders/items?channelKey={channelKey}',
        ],
        'get'=>[
            'new_item_sold' => 'feeds/en/clients/{client}/products/{productID}?channelKey={channelKey}'
        ]
    ];

    public array $params;

    public function __construct(array $params=[])
    {
        $this->params = $params;
    }

    public static function get(array $params=[]): DressCodeEndPoints
    {
        return new DressCodeEndPoints($params);
    }

    //Recupera tutti gli endpoint
    public function getAllEndPoints():array{
        return self::END_POINTS;
    }

    //Recupera un endpoint
    public function endPoint($name):string{
        //post.get_new_item_sold
        $endpoints = explode('.',$name);
        //check if exists
        if(!isset(self::END_POINTS[$endpoints[0]][$endpoints[1]])){
            throw new Exception('Endpoint not found');
        }
        $url = self::BASE_URL. self::END_POINTS[$endpoints[0]][$endpoints[1]];
        //replace params
        foreach ($this->params as $key => $value) {
            $url = str_replace('{'.$key.'}',$value,$url);
        }
        return $url;
    }

    /**
     * @throws Exception
     */
    public function getNewItemSoldEndPoint(string $product_ID = null,string $channelKey = null):string{
        //if $product_ID is not empty, replace params['productID']
        if(!empty($product_ID)){
            $this->params['productID'] = $product_ID;
        }
        //if $channelKey is not empty, replace params['channelKey']
        if(!empty($channelKey)){
            $this->params['channelKey'] = $channelKey;
        }

        try {
            $endpoint = $this->endPoint('get.new_item_sold');
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }

        return $endpoint;
    }

    public function postNewItemSoldEndpoint(string $channelKey = null):string{
        //if $channelKey is not empty, replace params['channelKey']
        if(!empty($channelKey)){
            $this->params['channelKey'] = $channelKey;
        }
        try {
            $endpoint = $this->endPoint('post.new_item_sold');
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
        return $endpoint;
    }

}
<?php
namespace Padosoft\DressCodeApi;
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

    public string $type;
    public array $params;

    public function __construct(string $type,array $params=[])
    {
        $this->type = $type;
        $this->params = $params;
    }

    public static function get(string $type,array $params=[]): DressCodeEndPoints
    {
        return new DressCodeEndPoints($type,$params);
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

}
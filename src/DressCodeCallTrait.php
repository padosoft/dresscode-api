<?php

namespace Padosoft\DressCodeApi;

trait DressCodeCallTrait
{



    public function postUpload(?string $channelKey = null, $json): mixed
    {
        $endpoint = DressCodeEndPoints::create()->postOrderItemsEndpoint($this->key->client_key, $channelKey);
        return $this->responsePost($endpoint, $json);
    }
    public function getStatus(): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getStatusEndpoint();
        return $this->responseGet($endpoint);
    }
}
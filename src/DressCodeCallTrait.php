<?php

namespace Padosoft\DressCodeApi;

trait DressCodeCallTrait
{
    public function postUpload(?string $hubkey = null, $json): mixed
    {
        $endpoint = DressCodeEndPoints::create()->postProductsEndpoint($hubkey);
        return $this->responsePost($endpoint, $json);
    }
    public function getStatus(): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getStatusEndpoint();
        return $this->responseGet($endpoint);
    }
}
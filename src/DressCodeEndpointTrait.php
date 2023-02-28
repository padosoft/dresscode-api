<?php

namespace Padosoft\DressCodeApi;

trait DressCodeEndpointTrait
{
    public function postJwtEndpoint(?string $key): string
    {
        if ($key !== null) {
            $this->params['key'] = $key;
        }

        return $this->getEndpoint('post.jwt_token');
    }

    public function getStatusEndpoint(): string
    {
        return $this->getEndpoint('get.status');
    }

    public function getOrdersEndpoint(string $orderID): string{
        if ($orderID !== null) {
            $this->params['orderID'] = $orderID;
        }
        return $this->getEndpoint('get.orders');
    }

}
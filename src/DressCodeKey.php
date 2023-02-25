<?php
namespace Padosoft\DressCodeApi;
class DressCodeKey
{
//costante versione API DressCode
const API_VERSION = '2.0';

protected string $subscription_key;
public string $client_key;

public function __construct(string $subscription_key, string $client_key)
{
    $this->subscription_key = $subscription_key;
    $this->client_key = $client_key;
}

public static function create(string $subscription_key, string $client_key): DressCodeKey
{
    return new DressCodeKey($subscription_key, $client_key);
}
}
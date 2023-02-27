<?php
namespace Padosoft\DressCodeApi;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class DressCodeKey
{
//costante versione API DressCode
const API_VERSION = '2.0';

protected string $username;
public string $password;

public string $jwt;

public function __construct(string $username, string $password, string $hub_key)
{
    $this->username = $username;
    $this->password = $password;
    $this->hub_key = $hub_key;

    $url = DressCodeEndPoints::create()->postJwtEndpoint($hub_key);

    $client = new Client();
    $data = [
        'data' => [
            'username' => $username,
            'password' => $password,
        ],
    ];
    $response = $client->post($url, [
        RequestOptions::JSON => $data
    ]);
    $json = $response->getBody()->getContents();
    $data = json_decode($json, true);

    $tokenExpires = $data['meta']['tokenExpires'];
    $this->jwt = $data['data']['code'];
}

public static function create(string $subscription_key, string $client_key): DressCodeKey
{
    return new DressCodeKey($subscription_key, $client_key);
}
}
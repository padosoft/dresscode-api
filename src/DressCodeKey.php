<?php
namespace Padosoft\DressCodeApi;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class DressCodeKey
{

protected string $username;
protected string $password;

public string $hub_key;
public string $subsciption_key;

public string $jwt;

public function __construct(string $username, string $password, string $hub_key, string $subscription_key)
{
    $this->username = $username;
    $this->password = $password;
    $this->hub_key = $hub_key;
    $this->subsciption_key = $subscription_key;


    $url = DressCodeEndPoints::create()->postJwtEndpoint($hub_key);
    $headers = [
        'Ocp-Apim-Subscription-Key' => $subscription_key,
    ];
    $client = new Client(['headers' => $headers]);

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

public static function create(string $username, string $password, string $hub_key, string $subscription_key): DressCodeKey
{
    return new DressCodeKey($username, $password, $hub_key, $subscription_key);
}
}
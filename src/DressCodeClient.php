<?php
namespace Padosoft\DressCodeApi;
use GuzzleHttp\Client;

class DressCodeClient
{


    protected DressCodeKey $key;
    public function __construct(DressCodeKey $key)
    {
        $this->key = $key;
    }

    public static function create(DressCodeKey $key): DressCodeClient
    {
        return new DressCodeClient($key);
    }

    public function client(): string
    {
        $this->client = new Client(
            [
                'base_uri' => self::BASE_URL,
            ]);
    }

    /**
     * @param       $method
     * @param       $path
     * @param array $options
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function makeRequest($method, $type, array $options = []): mixed
    {
        $path =  ($type, $options);
        $response = $this->client->request($method, $path, $options);
        return json_decode($response->getBody()->getContents(), true);
    }




}
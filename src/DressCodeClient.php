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
                'base_uri' => DressCodeEndPoints::BASE_URL,
            ]);
        return '';
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
return '';
    }




}
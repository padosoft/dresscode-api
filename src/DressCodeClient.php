<?php
namespace Padosoft\DressCodeApi;
use GuzzleHttp\Client;

class DressCodeClient
{

    protected Client $client;

    protected DressCodeKey $key;
    public function __construct(DressCodeKey $key)
    {
        $this->key = $key;
    }

    public static function create(DressCodeKey $key): DressCodeClient
    {
        return new DressCodeClient($key);
    }

    public function execute(): Client
    {
        $this->client = new Client(
            [
                'base_uri' => DressCodeEndPoints::BASE_URL,
            ]);
        return $this->client;
    }

    /**
     * @param       $method
     * @param       $path
     * @param array $options
     *
     * @return mixed
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getNewItemSold(?string $productID = null, ?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getNewItemSoldEndpoint($this->key->client_key, $productID, $channelKey);
        $response = $this->execute()->get($endpoint);
        return json_decode($response->getBody()->getContents(), true);
    }




}
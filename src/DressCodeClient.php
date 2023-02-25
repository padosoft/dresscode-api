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
        return $this->responseGet($endpoint);
    }

    public function urlWithoutQuery(string $endpoint): string
    {

// Separo l'URL dalla query string
        list($urlWithoutQuery, $queryString) = explode('?', $endpoint, 2);

// Genero un array associativo con i parametri della query string
        parse_str($queryString, $query);
        return $urlWithoutQuery;
    }
    public function queryFromUrl(string $endpoint): array
    {

// Separo l'URL dalla query string
        list($urlWithoutQuery, $queryString) = explode('?', $endpoint, 2);

// Genero un array associativo con i parametri della query string
        parse_str($queryString, $query);
        return $query;
    }

    public function responseGet($endpoint){
        $response = $this->execute()->get($this->urlWithoutQuery($endpoint), $this->queryFromUrl($endpoint));
        return json_decode($response->getBody()->getContents(), true);
    }



}
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
        $this->client = new Client(
            [
                'base_uri' => DressCodeEndPoints::BASE_URL,
            ]);
        return $this->client;
    }

    public static function create(DressCodeKey $key): DressCodeClient
    {
        return new DressCodeClient($key);
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

    public function postNewItemSold(?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->postNewItemSoldEndpoint($this->key->client_key, $channelKey);
        return $this->responsePost($endpoint);
    }

    public function getStatus(): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getStatusEndpoint();
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
        $response = $this->client->get($this->urlWithoutQuery($endpoint), $this->queryFromUrl($endpoint));
        return json_decode($response->getBody()->getContents(), true);
    }

    public function responsePost($endpoint){
        $response = $this->client->post($this->urlWithoutQuery($endpoint), $this->queryFromUrl($endpoint));
        return json_decode($response->getBody()->getContents(), true);
    }

}
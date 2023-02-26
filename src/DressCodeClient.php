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


    public function postOrderItems(?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->postOrderItemsEndpoint($this->key->client_key, $channelKey);
        return $this->responsePost($endpoint);
    }

    public function getProduct(?string $productID = null, ?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getProductEndpoint($this->key->client_key, $productID, $channelKey);
        return $this->responseGet($endpoint);
    }

    public function getProducts(?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getProductsEndpoint($this->key->client_key, $channelKey);
        return $this->responseGet($endpoint);
    }

    public function getExcelProducts(?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getExcelProductsEndpoint($this->key->client_key, $channelKey);
        return $this->responseGet($endpoint);
    }

    public function getStocks(?string $channelKey = null): mixed
    {
        $endpoint = DressCodeEndPoints::create()->getStockEndpoint($this->key->client_key, $channelKey);
        return $this->responseGet($endpoint);
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

    public function responseGet(string $endpoint, array $options = [],array $from =[]){
        $response = $this->client->get($this->urlWithoutQuery($endpoint), $this->queryFromUrl($endpoint));
        return json_decode($response->getBody()->getContents(), true);
    }

    public function responsePost($endpoint){
        $response = $this->client->post($this->urlWithoutQuery($endpoint), $this->queryFromUrl($endpoint));
        return json_decode($response->getBody()->getContents(), true);
    }
}
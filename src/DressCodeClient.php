<?php
namespace Padosoft\DressCodeApi;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class DressCodeClient
{

    use DressCodeCallTrait;


    protected Client $client;

    protected DressCodeKey $key;

    protected array $headers = [];

    protected function putValueInHeaders(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }
    public function __construct(DressCodeKey $key)
    {
        $this->key = $key;
        $this->putValueInHeaders('Authorization', $this->key->jwt);
        $this->putValueInHeaders('Ocp-Apim-Subscription-Key', $this->key->subsciption_key);
        $this->putValueInHeaders('Content-Type', 'application/json');
        $this->putValueInHeaders('Cache-Control', 'no-cache');
        $this->client = new Client();
        return $this->client;
    }

    public static function create(DressCodeKey $key): DressCodeClient
    {
        return new DressCodeClient($key);
    }

    public function urlWithoutQuery(string $endpoint): string
    {
        // Separo l'URL dalla query string
        [$urlWithoutQuery, $queryString] = explode('?', $endpoint, 2);
        // Genero un array associativo con i parametri della query string
        parse_str($queryString, $query);
        return $urlWithoutQuery;
    }

    public function queryFromUrl(string $endpoint): array
    {
        // Separo l'URL dalla query string
        [$urlWithoutQuery, $queryString] = explode('?', $endpoint, 2);
        // Genero un array associativo con i parametri della query string
        parse_str($queryString, $query);
        return $query;
    }

    public function responseGet(string $endpoint, array $options = [],array $from =[]){
        $options = [
            'headers' => $this->headers,
            'query' => $this->queryFromUrl($endpoint)
        ];
        $response = $this->client->request('get',$this->urlWithoutQuery($endpoint), $options);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function responsePost($endpoint, $json){
        $options = [
            'headers' => $this->headers,
            'query' => $this->queryFromUrl($endpoint)
        ];
        $response = $this->client->request('post',$this->urlWithoutQuery($endpoint), $options)->withBody($json);
        return json_decode($response->getBody()->getContents(), true);
    }
}
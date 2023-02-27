<?php
namespace Padosoft\DressCodeApi;

use Exception;

/**
 * Classe che gestisce gli endpoint della API DressCode
 */
class DressCodeEndPoints
{
    // Costante URL base
    const BASE_URL = 'https://api.dresscode.cloud/hub/v1/';

    /**
     * Definizione degli endpoint disponibili
     */
    const END_POINTS = [
        'post' => [
            'jwt_token' => 'tokens?hubKey={key}',
            'order_items' => 'api/feeds/en/clients/{client}/orders/items?channelKey={channelKey}',
        ],
        'get' => [
            'product' => 'api/feeds/en/clients/{client}/products/{productID}?channelKey={channelKey}',
            'products' => 'api/feeds/en/clients/{client}/products?channelKey={channelKey}',
            'excel_products' => 'export/excel/en/products?channelKey={channelKey}&client={client}',
            'stock' => 'api/feeds/en/clients/{client}/stocks?channelKey={channelKey}',
            'status' => 'status',
        ],
    ];

    /**
     * Parametri opzionali per gli endpoint
     */
    private array $params;

    /**
     * Costruttore della classe
     *
     * @param array $params Array associativo di parametri opzionali
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * Metodo per creare una nuova istanza della classe
     *
     * @param array $params Array associativo di parametri opzionali
     *
     * @return DressCodeEndPoints
     */
    public static function create(array $params = []): DressCodeEndPoints
    {
        return new DressCodeEndPoints($params);
    }

    /**
     * Metodo per recuperare tutti gli endpoint
     *
     * @return array Array associativo degli endpoint disponibili
     */
    public function getAllEndPoints(): array
    {
        return self::END_POINTS;
    }

    /**
     * Metodo per recuperare un endpoint specifico
     *
     * @param string $endpointName Nome dell'endpoint richiesto
     *
     * @return string URL dell'endpoint richiesto
     *
     * @throws Exception Se l'endpoint richiesto non esiste
     */
    public function getEndpoint(string $endpointName): string
    {
        $endpointParts = explode('.', $endpointName);

        if (!isset(self::END_POINTS[$endpointParts[0]][$endpointParts[1]])) {
            throw new Exception('Endpoint not found');
        }

        $endpointUrl = self::BASE_URL . self::END_POINTS[$endpointParts[0]][$endpointParts[1]];

        foreach ($this->params as $key => $value) {
            $endpointUrl = str_replace('{' . $key . '}', $value, $endpointUrl);
        }

        return $endpointUrl;
    }

    /**
     * Metodo per recuperare l'endpoint "new_item_sold" di tipo POST
     *
     * @param string|null $channelKey Chiave del canale (opzionale)
     *
     * @return string URL dell'endpoint richiesto
     *
     * @throws Exception Se l'endpoint richiesto non esiste
     */
    public function postOrderItemsEndpoint(?string $client, ?string $channelKey = null): string
    {
        if ($channelKey !== null) {
            $this->params['channelKey'] = $channelKey;
        }
        if ($client !== null) {
            $this->params['client'] = $client;
        }

        return $this->getEndpoint('post.order_items');
    }

    public function postJwtEndpoint(?string $key): string
    {
        if ($key !== null) {
            $this->params['key'] = $key;
        }

        return $this->getEndpoint('jwt_token');
    }
    /**
     * Metodo per recuperare l'endpoint "new_item_sold" di tipo GET
     *
     * @param string|null $productID Identificativo del prodotto (opzionale)
     * @param string|null $channelKey Chiave del canale (opzionale)
     *
     * @return string URL dell'endpoint richiesto
     *
     * @throws Exception Se l'endpoint richiesto non esiste
     */
    public function getProductEndpoint(?string $client,?string $productID = null, ?string $channelKey = null): string
    {
        if ($productID !== null) {
            $this->params['productID'] = $productID;
        }

        if ($channelKey !== null) {
            $this->params['channelKey'] = $channelKey;
        }

        if ($client !== null) {
            $this->params['client'] = $client;
        }

        return $this->getEndpoint('get.product');
    }

    public function getProductsEndpoint(?string $client, ?string $channelKey = null): string
    {

        if ($channelKey !== null) {
            $this->params['channelKey'] = $channelKey;
        }

        if ($client !== null) {
            $this->params['client'] = $client;
        }

        return $this->getEndpoint('get.products');
    }

    public function getExcelProductsEndpoint(?string $client, ?string $channelKey = null): string
    {

        if ($channelKey !== null) {
            $this->params['channelKey'] = $channelKey;
        }

        if ($client !== null) {
            $this->params['client'] = $client;
        }

        return $this->getEndpoint('get.products');
    }
    public function getStockEndpoint(?string $client, ?string $channelKey = null): string
    {

        if ($channelKey !== null) {
            $this->params['channelKey'] = $channelKey;
        }

        if ($client !== null) {
            $this->params['client'] = $client;
        }

        return $this->getEndpoint('get.stocks');
    }
    public function getStatusEndpoint(): string
    {
        return $this->getEndpoint('get.status');
    }

}
<?php
namespace Padosoft\DressCodeApi;

use Exception;

/**
 * Classe che gestisce gli endpoint della API DressCode
 */
class DressCodeEndPoints
{
    use DressCodeEndpointTrait;
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
            'orders' => 'eversell/orders/{orderID}?hubKey={hubKey}',
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


}
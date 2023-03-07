Certamente, ecco la documentazione con la formattazione MD:

Documentazione per l'utilizzo di DressCodeApi
=============================================

Introduzione
------------

La seguente documentazione descrive come utilizzare la libreria `DressCodeApi` per effettuare chiamate all'API DressCode.

Prerequisiti
------------

Per utilizzare `DressCodeApi`, è necessario:

*   Avere un account DressCode attivo
*   Avere le credenziali di accesso all'API DressCode

Installazione
-------------

Per utilizzare `DressCodeApi`, è necessario installare la libreria tramite composer. Eseguire il comando seguente:

```
composer require padosoft/dresscode-api
```

Utilizzo
--------

Per utilizzare `DressCodeApi`, seguire i seguenti passaggi:

1.  Importare la classe `DressCodeClient` e `DressCodeKey`.

```php
use Padosoft\DressCodeApi\DressCodeClient; use Padosoft\DressCodeApi\DressCodeKey;
```

2.  Creare un'istanza della classe `DressCodeKey`, specificando i parametri necessari.

```php
$key = DressCodeKey::create('CODICE_NEGOZIO', 'CLIENT_ID', 'CLIENT_SECRET', 'JWT_SECRET');
```

3.  Per ottenere il token JWT, utilizzare la proprietà `jwt`.

```php
$key->jwt;
```

4.  Creare un'istanza della classe `DressCodeClient`, passando come parametro l'istanza della classe `DressCodeKey`. Utilizzare il metodo `getStatus()` per ottenere lo stato dell'API.

```php
$client = DressCodeClient::create($key)->getStatus();
```

Esempio completo
----------------
```php
use Padosoft\DressCodeApi\DressCodeClient; use Padosoft\DressCodeApi\DressCodeKey;  $key = DressCodeKey::create('ANTANI', 'sdfgasfdgasdfg', 'k','9de0d59c2fc4567fwfef34faeaf92a0');  $key->jwt;  $client = DressCodeClient::create($key)->getStatus();
```

# DressCodeClient

La classe DressCodeClient è una classe PHP che implementa un client per l'API DressCode. La classe è definita nel namespace Padosoft\DressCodeApi e utilizza la libreria GuzzleHttp\Client per eseguire le richieste HTTP all'API.

La classe DressCodeClient implementa il trait DressCodeCallTrait che definisce i metodi per le chiamate alle API DressCode.

## Proprietà

- `protected Client $client`: una istanza del client GuzzleHttp\Client
- `protected DressCodeKey $key`: una istanza della classe DressCodeKey che rappresenta la chiave di accesso all'API DressCode
- `protected array $headers`: un array associativo contenente le intestazioni HTTP da inviare con le richieste alle API
- `protected string $base_uri`: l'URL base dell'API DressCode

## Metodi

- `public function __construct(DressCodeKey $key)`: un costruttore che riceve come parametro un'istanza di DressCodeKey e inizializza la proprietà $key con il valore passato. Il costruttore imposta anche le intestazioni HTTP necessarie per l'autenticazione all'API.
- `public static function create(DressCodeKey $key): DressCodeClient`: un metodo statico che restituisce una nuova istanza della classe DressCodeClient.
- `public function urlWithoutQuery(string $endpoint): string`: un metodo che riceve come parametro l'endpoint dell'API DressCode e restituisce l'URL senza la query string.
- `public function queryFromUrl(string $endpoint): array`: un metodo che riceve come parametro l'endpoint dell'API DressCode e restituisce un array associativo contenente i parametri della query string.
- `protected function putValueInHeaders(string $key, string $value): void`: un metodo che riceve come parametro il nome della intestazione HTTP e il valore e imposta la proprietà $headers con il valore passato.
- `public function responseGet(string $endpoint, array $options = [],array $from =[]): array`: un metodo che esegue una richiesta HTTP GET all'API DressCode. Il metodo riceve come parametro l'endpoint dell'API, le opzioni di richiesta (opzionale) e i parametri della query string (opzionale). Il metodo restituisce la risposta dell'API in formato JSON.
- `public function responsePost($endpoint, $json): array`: un metodo che esegue una richiesta HTTP POST all'API DressCode. Il metodo riceve come parametro l'endpoint dell'API e i dati da inviare con la richiesta in formato JSON. Il metodo restituisce la risposta dell'API in formato JSON.

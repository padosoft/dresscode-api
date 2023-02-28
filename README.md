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
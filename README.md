Hermitage PHP Client
====================

PHP Client for [Hermitage](https://github.com/LiveTyping/hermitage).

# Installation

Run the [Composer](http://getcomposer.org/download/) command to install the latest version:

```bash
composer require livetyping/hermitage-php-client ~0.1
```

# Usage

```php
<?php

use livetyping\hermitage\client\Client;
use livetyping\hermitage\client\RequestSigner;
use livetyping\hermitage\client\Signer;

$secret = '<secret value>';
$baseUri = 'http://hermitage';

$signer = new RequestSigner(new Signer($secret));
$client = new Client($signer, new \GuzzleHttp\Client(), $baseUri);

/** @var \Psr\Http\Message\ResponseInterface $response */
$response = $client->upload(file_get_contents('path/to/local/image'));
$filename = json_decode((string)$response->getBody());
$filename = $filename['filename'];

$response = $client->get($filename, '<version name>');

$response = $client->delete($filename);

/** @var \Psr\Http\Message\UriInterface $uri */
$uri = $client->uriFor($filename, '<version name>');
```

# License

Hermitage PHP Client is licensed under the MIT License.

See the [LICENSE](LICENSE) file for more information.

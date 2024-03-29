# A SIMPLE PHP JWT PACKAGE

## Installation

Require this package with composer:
```
composer require henryeticom/php-jwt
```

## Create JWT (Basic):
```php

use HenryEticom\PHPJWT\JWT;

$secret = 'your-secret-key';

$headers = array(
    'alg' => 'ES256',
    'typ' => 'JWT'
);

$payload = array(
    'sub'       => 1,
    'name'      => 'Test',
    'exp' => (time() + (60 * 60))
);

$jwt = JWT::encode($headers, $payload, $secret);

var_dump($jwt);
```

## Decode JWT (Basic):

```php

use HenryEticom\PHPJWT\JWT;

$jwt = 'response-from-encode';

$secret = 'your-secret-key';

$decode = JWT::decode($jwt, $secret);

var_dump($decode);

```


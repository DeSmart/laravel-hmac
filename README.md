# PHP HMAC #️⃣

[![Latest version](https://img.shields.io/packagist/v/desmart/php-hmac.svg?style=flat)](https://github.com/DeSmart/php-hmac)
![Tests](https://github.com/desmart/php-hmac/workflows/Run%20Tests/badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/DeSmart/php-hmac/blob/master/LICENSE)

Package provides a very simple object wrapper for HMAC-based hash.

## Installation
To install the package via Composer, simply run the following command:
```
composer require desmart/php-hmac
```

## Usage
Create a HMAC object:
```php
$hmac = HMAC::create('hash-key', 'string to hash'); // use default hashing algorithm (SHA256)
$hmac = HMAC::create('hash-key', 'string to hash', 'sha512'); // use SHA512 as hashing algorithm
$hmac = HMAC::create('hash-key', 'string to hash', 'sha512', true); // use raw output (instead of lowercase hexits)
```

Create a HMAC object from hash:
```php
$hmac = HMAC::createFromHash('hash-key', 'hash');
```

Compare two HMAC objects:
```php
$hmac = HMAC::create('hash-key', 'string to hash');
$otherHmac = HMAC::createFromHash('hash-key', 'hashed string');

$hmac->isEqual($otherHmac);
```

### Default hashing algorithm
By default, a HMAC hash will be produced using a SHA256 algorithm. It can be changed:
```php
HMAC::$defaultHashingAlgo = 'sha512';
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
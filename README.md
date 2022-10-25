# This is Lara Platform Core

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraplatform/core.svg?style=flat-square)](https://packagist.org/packages/laraplatform/core)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/laraplatform/core/run-tests?label=tests)](https://github.com/laraplatform/core/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/laraplatform/core/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/laraplatform/core/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/laraplatform/core.svg?style=flat-square)](https://packagist.org/packages/laraplatform/core)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require laraplatform/core
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="core-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="core-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="core-views"
```

## Usage

```php
$laraCore = new LaraPlatform\Core();
echo $laraCore->echoPhrase('Hello, LaraPlatform!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nguyen Van Hau](https://github.com/laraplatform)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
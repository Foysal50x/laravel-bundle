# This is my package laravel-bundle

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faisal50x/laravel-bundle.svg?style=flat-square)](https://packagist.org/packages/faisal50x/laravel-bundle)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/faisal50x/laravel-bundle/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/faisal50x/laravel-bundle/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/faisal50x/laravel-bundle/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/faisal50x/laravel-bundle/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/faisal50x/laravel-bundle.svg?style=flat-square)](https://packagist.org/packages/faisal50x/laravel-bundle)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require faisal50x/laravel-bundle
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="bundle-config"
```

This is the contents of the published config file:

```php
// config for Faisal50x/Laravel-bundle
return [
    'model_dir' => 'Models',
    'repository' => [
        /**
         * Define your repository directory here
         * Default path is app/Repositories
         */
        'dir' => 'Repositories',
        /**
         * Define your repository contract path here
         * Default path is app/Repositories/Contracts
         */
        'contract' => [
            'dir' => 'Contracts',
        ],
        'modules' => [
            /**
             * module base direct
             * default path is modules inside your project root directory
             */
            'base_dir' => 'modules',
            /**
             * Module source directory
             * default module/app/Repositories
             */
            'src_dir' => 'app',
        ],
    ],
];
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

- [Faisal Ahmed](https://github.com/Faisal50x)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

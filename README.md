
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# Laravel Vapor Support

[![Latest Version on Packagist](https://img.shields.io/packagist/v/richardstyles/laravel-vapor-support.svg?style=flat-square)](https://packagist.org/packages/richardstyles/laravel-vapor-support)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/richardstyles/laravel-vapor-support/run-tests?label=tests)](https://github.com/richardstyles/laravel-vapor-support/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/richardstyles/laravel-vapor-support/Check%20&%20fix%20styling?label=code%20style)](https://github.com/richardstyles/laravel-vapor-support/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/richardstyles/laravel-vapor-support.svg?style=flat-square)](https://packagist.org/packages/richardstyles/laravel-vapor-support)

A small support package to help large Vapor applications which may occasionally hit "Internal Server Error" due to large request sizes. 

This package provides a middleware to monitor the main response:
* Illuminate\Http\Response
* Illuminate\Http\JsonResponse
* Symfony\Component\HttpFoundation\BinaryFileResponse

There is also support for: 
* Symfony\Component\HttpFoundation\StreamedResponse
However because a streamed response length is generally unknown, by default a 'info' level log is recorded to aid debugging. 


## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-vapor-support.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-vapor-support)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require richardstyles/laravel-vapor-support
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-vapor-support-config"
```

This is the contents of the published config file:

```php
return [
    'warning_size' => env('VAPOR_SUPPORT_RESPONSE_WARNING_SIZE', 5000000),
    'warning_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeWarning::class,


    'limit_size' => env('VAPOR_SUPPORT_RESPONSE_LIMIT_SIZE', 6000000),
    'limit_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeLimit::class,

    'stream_action' => \RichardStyles\LaravelVaporSupport\Actions\StreamResponseMonitor::class,
];
```

## Usage

Simply add the middleware to either the Kernal.

app/Http/Kernel.php
```php

protected $middlewareGroups = [
        'web' => [
             ...
            \RichardStyles\LaravelVaporSupport\Http\Middleware\ResponseLimitMonitor::class,
        ],
        ...
```
Or as a named middleware to use on individual routes.
```php
protected $routeMiddleware = [
        ...
        'response.monitor' => \RichardStyles\LaravelVaporSupport\Http\Middleware\ResponseLimitMonitor::class,
    ];
```

For monitoring response sizes, these can be set in your .ENV, or by modifying the config.

*Examples set very low*
```env
VAPOR_SUPPORT_RESPONSE_WARNING_SIZE=1000
VAPOR_SUPPORT_RESPONSE_LIMIT_SIZE=5000
```
Example above, warning class run when response body exceeds "1000" bytes. Limit class runs when response body exceeds "5000" bytes.

The config also allows the base classes to be overridden. The Limit and Warning classes must implement `RichardStyles\LaravelVaporSupport\Contracts\HandlesResponsesLimit`
The stream response should implement `RichardStyles\LaravelVaporSupport\Contracts\HandlesStreamResponse` as with streamed responses you cannot easily know it's length.

The default actions taken by this package is to Log either:
- Log info on streamed response
- Log warning when request length exceeds ``warning_size`
- Log critical when request length exceeds `limit_size`

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Support

If you are having general issues with this package, feel free to contact me on [Twitter](https://twitter.com/StylesGoTweet).

If you believe you have found an issue, please report it using the [GitHub issue tracker](https://github.com/RichardStyles/EloquentEncryption/issues), or better yet, fork the repository and submit a pull request with a failing test.

If you're using this package, I'd love to hear your thoughts. Thanks!

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Richard Styles](https://github.com/RichardStyles)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

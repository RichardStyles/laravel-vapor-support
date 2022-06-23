<?php

namespace RichardStyles\LaravelVaporSupport;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use RichardStyles\LaravelVaporSupport\Exceptions\InvalidConfig;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelVaporSupportServiceProvider extends PackageServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function packageBooted()
    {
        Response::macro('getLength', function () {
            /** @var Response $this */
            return strlen($this->getContent());
        });

        JsonResponse::macro('getLength', function () {
            /** @var JsonResponse $this */
            return strlen($this->getContent());
        });

        $this->app->singleton(LaravelSupportConfig::class, function () {
            $config = config('vapor-support');
            if (empty($config)) {
                throw InvalidConfig::couldNotFindConfig('vapor-support');
            }

            return new LaravelSupportConfig($config);
        });
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-vapor-support')
            ->hasConfigFile();
    }
}

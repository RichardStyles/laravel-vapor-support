<?php

namespace RichardStyles\LaravelVaporSupport\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RichardStyles\LaravelVaporSupport\LaravelVaporSupport
 */
class LaravelVaporSupport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-vapor-support';
    }
}

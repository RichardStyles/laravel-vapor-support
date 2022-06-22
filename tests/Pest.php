<?php

use Illuminate\Http\Request;

use RichardStyles\LaravelVaporSupport\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

uses(TestCase::class)->in(__DIR__);


function createRequest($method, $uri): Request
{
    return Request::createFromBase(
        SymfonyRequest::create(
            $uri,
            $method
        )
    );
}

function createRawContent($length = 100): string
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

#[ArrayShape(['warning_size' => "int", 'warning_action' => "string", 'limit_size' => "int", 'limit_action' => "string", 'stream_action' => "string"])]
function getValidConfig(): array
{
    return [
        'warning_size' => 1000,
        'warning_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeWarning::class,


        'limit_size' => 5000,
        'limit_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeLimit::class,

        'stream_action' => \RichardStyles\LaravelVaporSupport\Actions\StreamResponseMonitor::class,
        ];
}

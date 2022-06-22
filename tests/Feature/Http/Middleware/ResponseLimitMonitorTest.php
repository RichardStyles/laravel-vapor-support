<?php

use function Pest\Laravel\get;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use RichardStyles\LaravelVaporSupport\Http\Middleware\ResponseLimitMonitor;

test('the middleware in isolation warning for regular response', function () {
    Log::shouldReceive('warning')
        ->once();

    $response = (new ResponseLimitMonitor())
        ->handle(
            createRequest('get', ''),
            fn () => new \Illuminate\Http\Response(
                createRawContent(501)
            )
        );
    expect($response->isSuccessful())->toBeTrue();
});

test('the middleware in isolation warning for json response', function () {
    Log::shouldReceive('warning')
        ->once();

    $response = (new ResponseLimitMonitor())
        ->handle(
            createRequest('get', ''),
            fn () => new \Illuminate\Http\JsonResponse(
                [ 'data' => createRawContent(500)]
            )
        );
    expect($response->isSuccessful())->toBeTrue();
});

test('the middleware in isolation limit for regular response', function () {
    Log::shouldReceive('critical')
        ->once();

    $response = (new ResponseLimitMonitor())
        ->handle(
            createRequest('get', ''),
            fn () => new \Illuminate\Http\Response(
                createRawContent(1100)
            )
        );
    expect($response->isSuccessful())->toBeTrue();
});

test('the middleware in isolation limit for json response', function () {
    Log::shouldReceive('critical')
        ->once();

    $response = (new ResponseLimitMonitor())
        ->handle(
            createRequest('get', ''),
            fn () => new \Illuminate\Http\JsonResponse(
                [ 'data' => createRawContent(1000)]
            )
        );
    expect($response->isSuccessful())->toBeTrue();
});

test('the middleware in isolation for stream response', function () {
    Log::shouldReceive('info')
        ->once();

    $response = (new ResponseLimitMonitor())
        ->handle(
            createRequest('get', ''),
            fn () => new StreamedResponse(fn () => createRawContent(101))
        );
    expect($response->isSuccessful())->toBeTrue();
});


test('the middleware in full app', function () {
    Log::shouldReceive('warning')
        ->once();

    Route::get('test-response', fn () => createRawContent(501))->middleware(ResponseLimitMonitor::class);

    get('test-response')->assertStatus(200);
});

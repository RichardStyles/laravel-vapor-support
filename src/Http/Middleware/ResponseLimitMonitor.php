<?php

namespace RichardStyles\LaravelVaporSupport\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RichardStyles\LaravelVaporSupport\Actions\HandleResponseLimit;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseLimitMonitor
{
    public function handle(Request $request, Closure $next)
    {
        /** @var Response|JsonResponse|BinaryFileResponse|StreamedResponse $response */
        $response = $next($request);

        app(HandleResponseLimit::class)->handle($request, $response);

        return $response;
    }
}

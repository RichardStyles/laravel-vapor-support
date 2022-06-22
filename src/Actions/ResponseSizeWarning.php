<?php

namespace RichardStyles\LaravelVaporSupport\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesResponsesLimit;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseSizeWarning implements HandlesResponsesLimit
{
    public function handle(Request $request, Response|JsonResponse|BinaryFileResponse|StreamedResponse $response, int $length)
    {
        Log::warning('Response has exceeded '.config('vapor-support.response.warning.size').' bytes', [
            'route' => $request->route()?->getName(),
            'path' => $request->path(),
            'response_size' => $length,
        ]);
    }
}

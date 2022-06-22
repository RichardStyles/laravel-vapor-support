<?php

namespace RichardStyles\LaravelVaporSupport\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface HandlesResponsesLimit
{
    /**
     * Handles a response for size notification or alert.
     *
     * @param Request $request
     * @param  Response|JsonResponse|BinaryFileResponse|StreamedResponse  $response
     * @param int $length
     */
    public function handle(Request $request, Response|JsonResponse|BinaryFileResponse|StreamedResponse $response, int $length);
}

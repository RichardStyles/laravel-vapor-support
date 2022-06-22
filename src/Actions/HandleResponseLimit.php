<?php

namespace RichardStyles\LaravelVaporSupport\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RichardStyles\LaravelVaporSupport\LaravelSupportConfig;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HandleResponseLimit
{

    public LaravelSupportConfig $config;

    public function __construct(LaravelSupportConfig $config)
    {
        $this->config = $config;
    }

    public function handle(Request $request, Response|JsonResponse|BinaryFileResponse|StreamedResponse $response)
    {
        $length = $this->getResponseLength($response);

        if (is_numeric($length) && $length > $this->config->limit) {
            return $this->config->limitClass->handle($request, $response, $length);
        }

        if (is_numeric($length) && $length > $this->config->warning) {
            return $this->config->warningClass->handle($request, $response, $length);
        }

        if ($response instanceof StreamedResponse) {
            return $this->config->streamClass->handle($request);
        }
    }

    public function getResponseLength(Response|JsonResponse|BinaryFileResponse|StreamedResponse $response): ?int
    {
        if ($response instanceof Response || $response instanceof JsonResponse) {
            return $response->getLength();
        }

        if ($response instanceof BinaryFileResponse) {
            return $response->getFile()->getSize();
        }

        return null;
    }
}

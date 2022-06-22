<?php

namespace RichardStyles\LaravelVaporSupport\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesStreamResponse;

class StreamResponseMonitor implements HandlesStreamResponse
{
    public function handle(Request $request): void
    {
        Log::info('Streamed Response detected, If you have "Internal Server Error" then it may be this route', [
            'route' => $request->route()?->getName(),
            'path' => $request->path(),
        ]);
    }
}

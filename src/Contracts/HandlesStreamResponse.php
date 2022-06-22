<?php

namespace RichardStyles\LaravelVaporSupport\Contracts;

use Illuminate\Http\Request;

interface HandlesStreamResponse
{
    public function handle(Request $request);
}


<?php

namespace RichardStyles\LaravelVaporSupport\Exceptions;

use Exception;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesResponsesLimit;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesStreamResponse;

class InvalidConfig extends Exception
{
    public static function couldNotFindConfig(string $notFoundConfigName): InvalidConfig
    {
        return new static("Could not find the configuration for `{$notFoundConfigName}`");
    }

    public static function invalidHandlesResponse(string $invalidHandlesResponseLimit): InvalidConfig
    {
        $handlesResponseLimitInterface = HandlesResponsesLimit::class;

        return new static("`{$invalidHandlesResponseLimit}` is not a valid handle response class. A valid handle response is a class that implements `{$handlesResponseLimitInterface}`.");
    }

    public static function invalidStreamedResponseHandler(string $invalidStreamedResponseHandler): InvalidConfig
    {
        $handlesStreamedResponseInterface = HandlesStreamResponse::class;

        return new static("`{$invalidStreamedResponseHandler}` is not a valid streamed response class. A valid streamed response is a class that implements `{$handlesStreamedResponseInterface}`.");
    }
}

<?php

namespace RichardStyles\LaravelVaporSupport;

use RichardStyles\LaravelVaporSupport\Contracts\HandlesResponsesLimit;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesStreamResponse;
use RichardStyles\LaravelVaporSupport\Exceptions\InvalidConfig;

class LaravelSupportConfig
{
    public int $limit;

    public HandlesResponsesLimit $limitClass;

    public int $warning;

    public HandlesResponsesLimit $warningClass;

    public HandlesStreamResponse $streamClass;

    /**
     * @throws InvalidConfig
     */
    public function __construct(array $properties)
    {
        if (empty($properties)) {
            throw InvalidConfig::couldNotFindConfig('vapor-support');
        }

        $this->limit = (int) $properties['limit_size'];

        $this->warning = (int) $properties['warning_size'];

        if (! is_subclass_of($properties['limit_action'], HandlesResponsesLimit::class)) {
            throw InvalidConfig::invalidHandlesResponse($properties['limit_action']);
        }

        $this->limitClass = app($properties['limit_action']);

        if (! is_subclass_of($properties['warning_action'], HandlesResponsesLimit::class)) {
            throw InvalidConfig::invalidHandlesResponse($properties['warning_action']);
        }

        $this->warningClass = app($properties['warning_action']);

        if (! is_subclass_of($properties['stream_action'], HandlesStreamResponse::class)) {
            throw InvalidConfig::invalidStreamedResponseHandler($properties['stream_action']);
        }

        $this->streamClass = app($properties['stream_action']);
    }
}

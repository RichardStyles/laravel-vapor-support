<?php

// config for RichardStyles/LaravelVaporSupport
return [
    /*
     * Sets the size in bytes and which warning action class should be run.
     * This should be a limit buffer before your requests reach over any limit, ie 90% of response limit.
     * */
    'warning_size' => env('VAPOR_SUPPORT_RESPONSE_WARNING_SIZE', 5000000),
    'warning_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeWarning::class,

    /*
     * set the size in bytes and which limit action class should be run.
     * This should be set at the response limit so these can be handled by the class. This class by defaults
     * adds a log entry, but you can switch this out to do anything such as notifications/emails.
     * */
    'limit_size' => env('VAPOR_SUPPORT_RESPONSE_LIMIT_SIZE', 6000000),
    'limit_action' => \RichardStyles\LaravelVaporSupport\Actions\ResponseSizeLimit::class,

    /*
     * Sets the class that should be run if a streamed response is detected.
     * This does not monitor size and is purely for monitoring purposes.
     * */
    'stream_action' => \RichardStyles\LaravelVaporSupport\Actions\StreamResponseMonitor::class,
];

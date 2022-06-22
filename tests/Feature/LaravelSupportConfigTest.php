<?php

use function Pest\Laravel\get;
use RichardStyles\LaravelVaporSupport\Exceptions\InvalidConfig;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesResponsesLimit;
use RichardStyles\LaravelVaporSupport\Contracts\HandlesStreamResponse;

test('it can handle a valid config', function () {
    $configArray = getValidConfig();

    $vaporSupportConfig = new \RichardStyles\LaravelVaporSupport\LaravelSupportConfig($configArray);

    $this->assertEquals($configArray['limit_size'], $vaporSupportConfig->limit);
    $this->assertEquals($configArray['limit_action'], $vaporSupportConfig->limitClass::class);
    $this->assertEquals($configArray['warning_size'], $vaporSupportConfig->warning);
    $this->assertEquals($configArray['warning_action'], $vaporSupportConfig->warningClass::class);
    $this->assertEquals($configArray['stream_action'], $vaporSupportConfig->streamClass::class);
});

test('no config throws exception', function(){

    $vaporSupportConfig = new \RichardStyles\LaravelVaporSupport\LaravelSupportConfig([]);

})->throws(InvalidConfig::class);

test('it handles invalid limit class', function () {
    $configArray = getValidConfig();
    $configArray['limit_action'] = 'invalid-class';
    $vaporSupportConfig = new \RichardStyles\LaravelVaporSupport\LaravelSupportConfig($configArray);

})->throws(InvalidConfig::class);

test('it handles invalid warning class', function () {
    $configArray = getValidConfig();
    $configArray['warning_action'] = 'invalid-class';
    $vaporSupportConfig = new \RichardStyles\LaravelVaporSupport\LaravelSupportConfig($configArray);

})->throws(InvalidConfig::class);

test('it handles invalid streaming class', function () {
    $configArray = getValidConfig();
    $configArray['stream_action'] = 'invalid-class';
    $vaporSupportConfig = new \RichardStyles\LaravelVaporSupport\LaravelSupportConfig($configArray);

})->throws(InvalidConfig::class);

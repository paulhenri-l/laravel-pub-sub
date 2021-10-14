<?php

use Illuminate\Support\Str;
use PaulhenriL\PubSubEngine\Drivers\EventBridgeDriverFactory;

return [
    /**
     * Eventbus classes. The key of an eventbus can then be used as a prefix
     * when sending an event using laravel.
     *
     * Event::dispatch('my_bus_name:my_event', ['my' => 'payload'])
     */
    'buses' => [
        'global' => [
            'factory' => EventBridgeDriverFactory::class,
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'token' => env('AWS_SESSION_TOKEN'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'endpoint' => env('EVENTBRIDGE_ENDPOINT'),
            'trace_header' => env('_X_AMZN_TRACE_ID'),
            'bus_name' => env('AWS_EVENTBUS_NAME'),
            'source' => Str::slug(env('APP_NAME', 'laravel'), '_'),
            'prefix' => Str::slug(env('APP_NAME', 'laravel'), '_') . ':',
        ]
    ]
];

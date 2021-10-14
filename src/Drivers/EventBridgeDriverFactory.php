<?php

namespace PaulhenriL\LaravelPubSub\Drivers;

use Aws\EventBridge\EventBridgeClient;
use Illuminate\Support\Arr;

class EventBridgeDriverFactory implements DriverFactoryInterface
{
    /**
     * Create a new instance of the driver with the given config.
     */
    public function make(array $config): DriverInterface
    {
        return new EventBridgeDriver(
            $this->newEventBridgeClient($config),
            $config
        );
    }

    /**
     * Create new EventBridge Client instance.
     */
    protected function newEventBridgeClient(array $config): EventBridgeClient
    {
        $eventBridgeConfig = [
            'region' => $config['region'],
            'version' => 'latest',
            'endpoint' => $config['endpoint'] ?? null,
        ];

        if (isset($config['key']) && isset($config['secret'])) {
            $eventBridgeConfig['credentials'] = Arr::only($config, [
                'key', 'secret', 'token'
            ]);
        }

        return new EventBridgeClient($eventBridgeConfig);
    }
}

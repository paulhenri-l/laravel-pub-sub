<?php

namespace PaulhenriL\LaravelPubSub\Drivers;

use Aws\EventBridge\EventBridgeClient;

class EventBridgeDriver implements DriverInterface
{
    /**
     * The EventBridgeClient instance.
     *
     * @var EventBridgeClient
     */
    protected $eventBridgeClient;

    /**
     * The Driver's config.
     *
     * @var array
     */
    protected $config;

    /**
     * AwsEventBridge constructor.
     */
    public function __construct(EventBridgeClient $eventBridgeClient, array $config)
    {
        $this->eventBridgeClient = $eventBridgeClient;
        $this->config = $config;
    }

    /**
     * Send the given event to AWS EventBridge.
     */
    public function send(string $name, $payload): void
    {
        $this->eventBridgeClient->putEvents([
            'Entries' => [
                [
                    'Detail' => json_encode($payload),
                    'DetailType' => $this->config['prefix'] . $name,
                    'EventBusName' => $this->config['bus_name'],
                    'Source' => $this->config['source'],
                    'TraceHeader' => $this->config['trace_header'],
                ]
            ]
        ]);
    }
}

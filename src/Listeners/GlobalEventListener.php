<?php

namespace PaulhenriL\LaravelPubSub\Listeners;

use PaulhenriL\LaravelPubSub\EventBus\EventBusInterface;

class GlobalEventListener
{
    /**
     * The EventBusInterface instance.
     *
     * @var EventBusInterface
     */
    protected $eventBus;

    /**
     * The PubSub config.
     *
     * @var array
     */
    protected $config;

    /**
     * GlobalEventListener constructor.
     */
    public function __construct(EventBusInterface $eventBus, array $config)
    {
        $this->eventBus = $eventBus;
        $this->config = $config;
    }

    /**
     * Forward the given event to the configured event bus.
     */
    public function handle(string $name, $payload): void
    {
        $name = preg_replace(
            '/^global:(.*)$/',
            "{$this->config['events_prefix']}\${1}",
            $name
        );

        $this->eventBus->send($name, $payload);
    }
}

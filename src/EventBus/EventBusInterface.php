<?php

namespace PaulhenriL\LaravelPubSub\EventBus;

interface EventBusInterface
{
    /**
     * Send an even with the given name and payload.
     */
    public function send(string $name, $payload): void;
}

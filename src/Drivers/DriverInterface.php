<?php

namespace PaulhenriL\LaravelPubSub\Drivers;

interface DriverInterface
{
    /**
     * Send an even with the given name and payload.
     */
    public function send(string $name, $payload): void;
}

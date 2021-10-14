<?php

namespace PaulhenriL\PubSubEngine\Drivers;

interface DriverInterface
{
    /**
     * Send an even with the given name and payload.
     */
    public function send(string $name, $payload): void;
}

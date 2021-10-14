<?php

namespace PaulhenriL\LaravelPubSub\Drivers;

interface DriverFactoryInterface
{
    /**
     * Create a new instance of the given driver with the given config.
     */
    public function make(array $config): DriverInterface;
}

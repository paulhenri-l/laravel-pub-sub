<?php

namespace PaulhenriL\LaravelPubSub\Tests\Fakes;

use PaulhenriL\LaravelPubSub\Drivers\DriverFactoryInterface;
use PaulhenriL\LaravelPubSub\Drivers\DriverInterface;

class FakeDriverFactory implements DriverFactoryInterface
{
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function make(array $config): DriverInterface
    {
        return $this->driver;
    }
}

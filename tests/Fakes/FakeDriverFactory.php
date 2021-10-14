<?php

namespace PaulhenriL\PubSubEngine\Tests\Fakes;

use PaulhenriL\PubSubEngine\Drivers\DriverFactoryInterface;
use PaulhenriL\PubSubEngine\Drivers\DriverInterface;

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

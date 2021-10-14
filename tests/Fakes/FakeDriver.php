<?php

namespace PaulhenriL\LaravelPubSub\Tests\Fakes;

use PaulhenriL\LaravelPubSub\Drivers\DriverFactoryInterface;
use PaulhenriL\LaravelPubSub\Drivers\DriverInterface;

class FakeDriver implements DriverInterface
{
    public $events = [];

    public function send(string $name, $payload): void
    {
        $this->events[] = compact('name', 'payload');
    }
}

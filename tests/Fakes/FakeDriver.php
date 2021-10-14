<?php

namespace PaulhenriL\PubSubEngine\Tests\Fakes;

use PaulhenriL\PubSubEngine\Drivers\DriverFactoryInterface;
use PaulhenriL\PubSubEngine\Drivers\DriverInterface;

class FakeDriver implements DriverInterface
{
    public $events = [];

    public function send(string $name, $payload): void
    {
        $this->events[] = compact('name', 'payload');
    }
}

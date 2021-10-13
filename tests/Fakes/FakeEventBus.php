<?php

namespace PaulhenriL\LaravelPubSub\Tests\Fakes;

use PaulhenriL\LaravelPubSub\EventBus\EventBusInterface;

class FakeEventBus implements EventBusInterface
{
    public $events = [];

    public function send(string $name, $payload): void
    {
        $this->events[] = compact('name', 'payload');
    }
}

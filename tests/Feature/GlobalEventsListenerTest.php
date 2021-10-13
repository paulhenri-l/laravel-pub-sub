<?php

namespace PaulhenriL\LaravelPubSub\Tests\Feature;

use Illuminate\Support\Facades\Event;
use PaulhenriL\LaravelPubSub\Tests\Fakes\FakeEventBus;
use PaulhenriL\LaravelPubSub\Tests\TestCase;

class GlobalEventsListenerTest extends TestCase
{
    public function test_that_global_events_are_sent_to_the_event_bus()
    {
        config()->set('pub_sub.event_bus', FakeEventBus::class);
        config()->set('pub_sub.events_prefix', 'my_prefix:');
        $this->app->instance(FakeEventBus::class, $bus = new FakeEventBus());

        Event::dispatch('global:hello', ['some' => 'payload']);

        $this->assertEquals([
            'name' => 'my_prefix:hello',
            'payload' => ['some' => 'payload']
        ], array_pop($bus->events));
    }
}

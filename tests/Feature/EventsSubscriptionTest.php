<?php

namespace PaulhenriL\LaravelPubSub\Tests\Feature;

use Illuminate\Support\Facades\Event;
use PaulhenriL\LaravelPubSub\Tests\Fakes\FakeDriver;
use PaulhenriL\LaravelPubSub\Tests\Fakes\FakeDriverFactory;
use PaulhenriL\LaravelPubSub\Tests\TestCase;

class EventsSubscriptionTest extends TestCase
{
    public function test_that_events_are_forwarded_to_the_correct_event_bus()
    {
        // Buses are configured inside the TestCase
        $this->app->instance('bus_1_classname', new FakeDriverFactory($bus1 = new FakeDriver()));
        $this->app->instance('bus_2_classname', new FakeDriverFactory($bus2 = new FakeDriver()));

        Event::dispatch('bus_1:hello', ['name' => 'bus_1']);
        Event::dispatch('bus_2:hello', ['name' => 'bus_2']);
        Event::dispatch('bus_3:hello', ['name' => 'bus_3']);

        $this->assertEquals([
            'name' => 'hello',
            'payload' => ['name' => 'bus_1']
        ], $bus1->events[0]);
        $this->assertCount(1, $bus1->events);

        $this->assertEquals([
            'name' => 'hello',
            'payload' => ['name' => 'bus_2']
        ], $bus2->events[0]);
        $this->assertCount(1, $bus2->events);
    }
}

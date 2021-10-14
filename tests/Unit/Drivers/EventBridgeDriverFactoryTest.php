<?php

namespace PaulhenriL\LaravelPubSub\Tests\Unit\Drivers;

use PaulhenriL\LaravelPubSub\Drivers\EventBridgeDriver;
use PaulhenriL\LaravelPubSub\Drivers\EventBridgeDriverFactory;
use PaulhenriL\LaravelPubSub\Tests\TestCase;

class EventBridgeDriverFactoryTest extends TestCase
{
    public function test_events_are_sent_to_aws()
    {
        $factory = new EventBridgeDriverFactory();

        $instance = $factory->make([
            'region' => 'eu-west-3',
            'key' => 'some-key',
            'secret' => 'some-secret',
        ]);

        $this->assertInstanceOf(EventBridgeDriver::class, $instance);
    }
}

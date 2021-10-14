<?php

namespace PaulhenriL\PubSubEngine\Tests\Unit\Drivers;

use PaulhenriL\PubSubEngine\Drivers\EventBridgeDriver;
use PaulhenriL\PubSubEngine\Drivers\EventBridgeDriverFactory;
use PaulhenriL\PubSubEngine\Tests\TestCase;

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

<?php

namespace PaulhenriL\PubSubEngine\Tests\Unit\Drivers;

use Aws\EventBridge\EventBridgeClient;
use Mockery;
use PaulhenriL\PubSubEngine\Drivers\EventBridgeDriver;
use PaulhenriL\PubSubEngine\Tests\TestCase;

class EventBridgeDriverTest extends TestCase
{
    public function test_events_are_sent_to_aws()
    {
        $mock = Mockery::mock(EventBridgeClient::class);

        $mock->shouldReceive('putEvents')->with([
            'Entries' => [[
                'Detail' => ['payload' => json_encode(['name' => 'world'])],
                'DetailType' => 'some-prefix:hello',
                'EventBusName' => 'some-bus-name',
                'Source' => 'some-source',
                'TraceHeader' => 'some-trace-id',
            ]],
        ]);

        $client = new EventBridgeDriver($mock, [
            'prefix' => 'some-prefix:',
            'bus_name' => 'some-bus-name',
            'source' => 'some-source',
            'trace_header' => 'some-trace-id',
        ]);

        $client->send('hello', ['name' => 'world']);
    }
}

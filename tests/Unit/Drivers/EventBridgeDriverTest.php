<?php

namespace PaulhenriL\LaravelPubSub\Tests\Unit\Drivers;

use Aws\EventBridge\EventBridgeClient;
use Mockery;
use PaulhenriL\LaravelPubSub\Drivers\EventBridgeDriver;
use PaulhenriL\LaravelPubSub\Tests\TestCase;

class EventBridgeDriverTest extends TestCase
{
    public function test_events_are_sent_to_aws()
    {
        $mock = Mockery::mock(EventBridgeClient::class);

        $mock->shouldReceive('putEvents')->with([
            'Entries' => [[
                'Detail' => json_encode(['name' => 'world']),
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

<?php

namespace PaulhenriL\LaravelPubSub\Tests\Feature;

use PaulhenriL\LaravelPubSub\LaravelPubSubServiceProvider;
use PaulhenriL\LaravelPubSub\Tests\TestCase;

class EngineLoadedTest extends TestCase
{
    public function test_that_the_engine_is_loaded()
    {
        $providers = $this->app->getLoadedProviders();

        $engineIsLoaded = $providers[LaravelPubSubServiceProvider::class] ?? false;

        $this->assertTrue($engineIsLoaded);
    }
}

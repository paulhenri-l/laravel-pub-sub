<?php

namespace PaulhenriL\LaravelPubSubEngine\Tests\Feature;

use PaulhenriL\LaravelPubSubEngine\LaravelPubSubEngineServiceProvider;
use PaulhenriL\LaravelPubSubEngine\Tests\TestCase;

class EngineLoadedTest extends TestCase
{
    public function test_that_the_engine_is_loaded()
    {
        $providers = $this->app->getLoadedProviders();

        $engineIsLoaded = $providers[LaravelPubSubEngineServiceProvider::class] ?? false;

        $this->assertTrue($engineIsLoaded);
    }
}

<?php

namespace PaulhenriL\PubSubEngine\Tests\Feature;

use PaulhenriL\PubSubEngine\PubSubEngineServiceProvider;
use PaulhenriL\PubSubEngine\Tests\TestCase;

class EngineLoadedTest extends TestCase
{
    public function test_that_the_engine_is_loaded()
    {
        $providers = $this->app->getLoadedProviders();

        $engineIsLoaded = $providers[PubSubEngineServiceProvider::class] ?? false;

        $this->assertTrue($engineIsLoaded);
    }
}

<?php

namespace PaulhenriL\LaravelPubSubEngine\Tests;

use Illuminate\Contracts\Console\Kernel;
use PaulhenriL\LaravelPubSubEngine\LaravelPubSubEngineServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelPubSubEngineServiceProvider::class
        ];
    }

    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        // Prevents an awful bug from happening. Without this line The Kernel
        // instance used by the EngineServiceProvider won't be the same as the
        // one used in the TestCase. (This issue only happens with orchestra)
        $app->make(Kernel::class);
    }
}

<?php

namespace PaulhenriL\PubSubEngine\Tests;

use Illuminate\Contracts\Console\Kernel;
use PaulhenriL\PubSubEngine\PubSubEngineServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $app->make('config')->set('pub_sub_engine.buses', [
            'bus_1' => ['factory' => 'bus_1_classname'],
            'bus_2' => ['factory' => 'bus_2_classname'],
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            PubSubEngineServiceProvider::class
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

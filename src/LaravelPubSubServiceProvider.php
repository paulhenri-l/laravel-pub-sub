<?php

namespace PaulhenriL\LaravelPubSub;

use PaulhenriL\LaravelEngineCore\Console\InstallTasks\PublishConfig;
use PaulhenriL\LaravelEngineCore\EngineServiceProvider;
use PaulhenriL\LaravelPubSub\Listeners\GlobalEventListener;

class LaravelPubSubServiceProvider extends EngineServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->autoregisterConfig();

        $this->app->bind(GlobalEventListener::class, function ($app) {
            $config = $app->make('config')->get('pub_sub');

            return new GlobalEventListener(
                $app->make($config['event_bus']),
                $config
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->addInstallCommand(PublishConfig::class);
        $this->addListener('global:*', GlobalEventListener::class);
    }
}

<?php

namespace PaulhenriL\LaravelPubSub;

use PaulhenriL\LaravelEngineCore\Console\InstallTasks\PublishConfig;
use PaulhenriL\LaravelEngineCore\EngineServiceProvider;
use PaulhenriL\LaravelPubSub\Listeners\PubSubBridge;

class LaravelPubSubServiceProvider extends EngineServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->autoregisterConfig();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $busesConfig = config('pub_sub.buses');
        $router = new EventRouter($this->app, $busesConfig);

        foreach ($busesConfig as $busName => $_) {
            $this->addListener(
                "$busName:*",
                function (string $name, $payload) use ($busName, $router) {
                    $router->route($busName, $name, $payload);
                }
            );
        }

        $this->addInstallCommand(PublishConfig::class);
    }
}

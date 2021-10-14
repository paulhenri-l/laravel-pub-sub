<?php

namespace PaulhenriL\PubSubEngine;

use Illuminate\Container\Container;
use PaulhenriL\PubSubEngine\Drivers\DriverInterface;

class EventRouter
{
    /**
     * The Container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * The event buses config.
     *
     * @var array
     */
    protected $busesConfig;

    /**
     * The cached driver instances.
     *
     * @var DriverInterface[]
     */
    protected $cachedDrivers = [];

    /**
     * EventRouter constructor.
     */
    public function __construct(Container $container, array $busesConfig)
    {
        $this->container = $container;
        $this->busesConfig = $busesConfig;
    }

    /**
     * Route the given event to the correct driver.
     */
    public function route(string $busName, string $eventName, $payload): void
    {
        $quotedName = preg_quote($busName);

        $eventName = preg_replace(
            "/^{$quotedName}:(.*)\$/",
            '${1}',
            $eventName
        );

        $this->getDriver($busName)->send($eventName, $payload);
    }

    /**
     * Return an instance of the given driver.
     */
    protected function getDriver(string $busName): DriverInterface
    {
        if (!($this->cachedDrivers[$busName] ?? null)) {
            $driverConfig = $this->busesConfig[$busName];

            // Yes it may be empty, but that would be because the user did not
            // read the documentation.
            $factory = $this->container->make(
                $driverConfig['factory']
            );

            $this->cachedDrivers[$busName] = $factory->make($driverConfig);
        }

        return $this->cachedDrivers[$busName];
    }
}

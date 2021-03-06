<?php namespace Anomaly\Streams\Platform\Addon;

use Illuminate\Container\Container;

/**
 * Class AddonBinder
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Addon
 */
class AddonBinder
{

    /**
     * The addon provider.
     *
     * @var AddonProvider
     */
    protected $provider;

    /**
     * The IoC container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The addon integrator.
     *
     * @var AddonIntegrator
     */
    protected $integrator;

    /**
     * The addon dispatcher.
     *
     * @var AddonDispatcher
     */
    protected $dispatcher;

    /**
     * The addon configuration utility.
     *
     * @var AddonConfiguration
     */
    protected $configuration;

    /**
     * Create a new AddonBinder instance.
     *
     * @param Container          $container
     * @param AddonProvider      $provider
     * @param AddonIntegrator    $integrator
     * @param AddonDispatcher    $dispatcher
     * @param AddonConfiguration $configuration
     */
    public function __construct(
        Container $container,
        AddonProvider $provider,
        AddonIntegrator $integrator,
        AddonDispatcher $dispatcher,
        AddonConfiguration $configuration
    ) {
        $this->provider      = $provider;
        $this->container     = $container;
        $this->dispatcher    = $dispatcher;
        $this->integrator    = $integrator;
        $this->configuration = $configuration;
    }

    /**
     * Register an addon.
     *
     * @param $path
     */
    public function register($path)
    {
        $vendor = basename(dirname($path));
        $slug   = substr(basename($path), 0, strpos(basename($path), '-'));
        $type   = substr(basename($path), strpos(basename($path), '-') + 1);

        $addon = studly_case($vendor) . '\\' . studly_case($slug) . studly_case($type) . '\\' . studly_case(
                $slug
            ) . studly_case($type);

        $addon = app($addon)
            ->setPath($path)
            ->setType($type)
            ->setSlug($slug)
            ->setVendor($vendor);

        $this->container->instance(get_class($addon), $addon);

        /**
         * Load addon configuration before running
         * the addon's service provider so we can
         * use configurable bindings.
         */
        $this->configuration->load($addon);

        $this->provider->register($addon);
        $this->integrator->register($addon);
        $this->dispatcher->addonWasRegistered($addon);
    }
}

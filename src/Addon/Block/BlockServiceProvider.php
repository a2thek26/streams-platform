<?php namespace Anomaly\Streams\Platform\Addon\Block;

use Anomaly\Streams\Platform\Addon\Block\Command\RegisterBlocks;
use Anomaly\Streams\Platform\Addon\Block\Command\RegisterListeners;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Support\ServiceProvider;

/**
 * Class BlockServiceProvider
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Addon\Block
 */
class BlockServiceProvider extends ServiceProvider
{

    use DispatchesCommands;

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->dispatch(new RegisterListeners());
        $this->dispatch(new RegisterBlocks());
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'Anomaly\Streams\Platform\Addon\Block\BlockCollection',
            'Anomaly\Streams\Platform\Addon\Block\BlockCollection'
        );
    }
}

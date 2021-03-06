<?php namespace Anomaly\Streams\Platform\Ui;

use Illuminate\Support\ServiceProvider;

/**
 * Class UiServiceProvider
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui
 */
class UiServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app->make('twig')->addExtension(app('Anomaly\Streams\Platform\Ui\UiPlugin'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\Streams\Platform\Ui\Form\FormServiceProvider');
        $this->app->register('Anomaly\Streams\Platform\Ui\Table\TableServiceProvider');
        $this->app->register('Anomaly\Streams\Platform\Ui\Button\ButtonServiceProvider');
    }
}

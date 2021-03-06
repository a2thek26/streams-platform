<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Illuminate\Support\ServiceProvider;

/**
 * Class FormServiceProvider
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui\Form
 */
class FormServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app->make('twig')->addExtension(app('Anomaly\Streams\Platform\Ui\Form\FormPlugin'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\Streams\Platform\Ui\Form\Component\Action\ActionServiceProvider');
    }
}

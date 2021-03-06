<?php namespace Anomaly\Streams\Platform\Addon\Block\Command\Handler;

use Illuminate\Events\Dispatcher;

/**
 * Class RegisterListenersHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Addon\Block\Command
 */
class RegisterListenersHandler
{

    /**
     * The event dispatcher.
     *
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Create a new RegisterListeners instance.
     *
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->dispatcher->listen(
            'Anomaly\Streams\Platform\Addon\Block\Event\BlockWasRegistered',
            'Anomaly\Streams\Platform\Addon\Block\Listener\PutBlockInCollection'
        );
    }
}

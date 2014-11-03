<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Traits\DispatchableTrait;
use Anomaly\Streams\Platform\Ui\Form\Event\AuthorizationFailedEvent;
use Anomaly\Streams\Platform\Ui\Form\Event\AuthorizationPassedEvent;

/**
 * Class HandleFormSubmissionAuthorizationCommandHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Command
 */
class HandleFormSubmissionAuthorizationCommandHandler
{

    use DispatchableTrait;

    /**
     * Handle the command.
     *
     * @param HandleFormSubmissionAuthorizationCommand $command
     * @return mixed
     */
    public function handle(HandleFormSubmissionAuthorizationCommand $command)
    {
        $ui = $command->getUi();

        $authorized = (app()->call($ui->toAuthorizer() . '@authorize', compact('ui')));

        if ($authorized) {

            $this->dispatch(new AuthorizationPassedEvent($ui));
        } else {

            $this->dispatch(new AuthorizationFailedEvent($ui));
        }

        return $authorized;
    }
}
 
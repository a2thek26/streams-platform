<?php namespace Anomaly\Streams\Platform\Assignment\Listener;

use Anomaly\Streams\Platform\Assignment\Command\AddAssignmentColumn;
use Anomaly\Streams\Platform\Assignment\Event\AssignmentWasCreated;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class AssignmentCreatedListener
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Assignment\Listener
 */
class AssignmentCreatedListener
{

    use DispatchesCommands;

    /**
     * When an assignment is created we need to
     * add it's database column to the entry table.
     *
     * @param AssignmentWasCreated $event
     */
    public function handle(AssignmentWasCreated $event)
    {
        $assignment = $event->getAssignment();

        $this->dispatch(new AddAssignmentColumn($assignment));
    }
}

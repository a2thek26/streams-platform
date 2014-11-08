<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

/**
 * Class BuildFormOptionsCommandHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Command
 */
class BuildFormOptionsCommandHandler
{

    /**
     * Handle the command.
     *
     * @param BuildFormOptionsCommand $command
     * @return array
     */
    public function handle(BuildFormOptionsCommand $command)
    {
        $form = $command->getForm();

        $stream = $form->getStream();

        $translatable = $stream->isTranslatable();

        return compact('translatable');
    }
}
 
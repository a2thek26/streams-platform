<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser\RedirectGuesser;

/**
 * Class ActionGuesser
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Component\Action
 */
class ActionGuesser
{

    /**
     * The redirect guesser.
     *
     * @var RedirectGuesser
     */
    protected $redirect;

    /**
     * Create a new ActionGuesser instance.
     *
     * @param RedirectGuesser $redirect
     */
    public function __construct(RedirectGuesser $redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Guess action properties.
     *
     * @param array $actions
     * @return array
     */
    public function guess(array $actions)
    {
        foreach ($actions as &$action) {
            $this->redirect->guess($action);
        }

        return $actions;
    }
}

<?php namespace Streams\Platform\Ui\Handler;

use Streams\Platform\Ui\FormUi;

class ActionHandler
{
    /**
     * The form UI object.
     *
     * @var
     */
    protected $ui;

    /**
     * Create a new FormHandler instance.
     *
     * @param FormUi $ui
     */
    public function __construct(FormUi $ui)
    {
        $this->ui = $ui;
    }

    /**
     * Redirect to the appropriate location.
     */
    public function redirect()
    {
        foreach ($this->ui->getActions() as $action) {
            if ($action['attributes']['value'] == \Input::get('formAction')) {
                break;
            }
        }

        \Messages::flash();

        $redirect = evaluate_key($action, 'redirect', '/poop', [$this->ui]);

        if (!starts_with($redirect, 'http')) {
            $redirect = url($redirect);
        }

        header('Location: ' . $redirect);
    }
}
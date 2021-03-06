<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Type;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewHandlerInterface;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ViewAllHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\View\Type
 */
class ViewAllHandler implements ViewHandlerInterface
{

    /**
     * Handle the TableQueryEvent.
     *
     * @param Table   $table
     * @param Builder $query
     * @return mixed
     */
    public function handle(Table $table, Builder $query)
    {
    }
}

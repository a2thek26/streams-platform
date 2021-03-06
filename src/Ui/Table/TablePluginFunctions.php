<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\Component\Column\Command\GetColumnValue;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract\ColumnInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Command\GetHeading;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Contract\HeaderInterface;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class TablePluginFunctions
 *
 * @link          http://anomaly.is/streams-plattable
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platforma\Ui\Table
 */
class TablePluginFunctions
{

    use DispatchesCommands;

    /**
     * Render the table's views.
     *
     * @param Table $table
     * @return \Illuminate\View\View
     */
    public function views(Table $table)
    {
        $options = $table->getOptions();

        return view($options->get('views_view', 'streams::ui/table/partials/views'), compact('table'));
    }

    /**
     * Render the table's filters.
     *
     * @param Table $table
     * @return \Illuminate\View\View
     */
    public function filters(Table $table)
    {
        $options = $table->getOptions();

        return view($options->get('filters_view', 'streams::ui/table/partials/filters'), compact('table'));
    }

    /**
     * Render the table's header.
     *
     * @param Table $table
     * @return \Illuminate\View\View
     */
    public function header(Table $table)
    {
        $options = $table->getOptions();

        return view($options->get('header_view', 'streams::ui/table/partials/header'), compact('table'));
    }

    /**
     * Render the table's body.
     *
     * @param Table $table
     * @return \Illuminate\View\View
     */
    public function body(Table $table)
    {
        $options = $table->getOptions();

        return view($options->get('body_view', 'streams::ui/table/partials/body'), compact('table'));
    }

    /**
     * Render the table's footer.
     *
     * @param Table $table
     * @return \Illuminate\View\View
     */
    public function footer(Table $table)
    {
        $options = $table->getOptions();

        return view($options->get('footer_view', 'streams::ui/table/partials/footer'), compact('table'));
    }

    /**
     * Return a column heading value.
     *
     * @param Table           $table
     * @param HeaderInterface $header
     * @return string
     */
    public function heading(Table $table, HeaderInterface $header)
    {
        return $this->dispatch(new GetHeading($table, $header));
    }

    /**
     * Return a column data value.
     *
     * @param Table           $table
     * @param ColumnInterface $column
     * @param                 $entry
     * @return string
     */
    public function column(Table $table, ColumnInterface $column, $entry)
    {
        return $this->dispatch(new GetColumnValue($table, $column, $entry));
    }
}

<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ColumnBuilder
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui\Table\Component\Column
 */
class ColumnBuilder
{

    /**
     * The column reader.
     *
     * @var ColumnInput
     */
    protected $input;

    /**
     * The column factory.
     *
     * @var ColumnFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ColumnBuilder instance.
     *
     * @param ColumnInput   $input
     * @param ColumnFactory $factory
     * @param Evaluator     $evaluator
     */
    public function __construct(ColumnInput $input, ColumnFactory $factory, Evaluator $evaluator)
    {
        $this->input     = $input;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the columns.
     *
     * @param TableBuilder $builder
     * @param              $entry
     * @return ColumnCollection
     */
    public function build(TableBuilder $builder, $entry)
    {
        $table = $builder->getTable();

        $columns = new ColumnCollection();

        $this->input->read($builder, $entry);

        foreach ($builder->getColumns() as $column) {

            $column = $this->evaluator->evaluate($column, compact('entry', 'table'));

            $columns->push($this->factory->make($column));
        }

        return $columns;
    }
}

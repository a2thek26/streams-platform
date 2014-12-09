<?php namespace Anomaly\Streams\Platform\Ui\Table\Filter\Command;

use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Database\Eloquent\Builder;

class HandleTableFiltersCommand
{

    protected $table;

    protected $query;

    function __construct(Table $table, Builder $query)
    {
        $this->table = $table;
        $this->query = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getTable()
    {
        return $this->table;
    }
}
 
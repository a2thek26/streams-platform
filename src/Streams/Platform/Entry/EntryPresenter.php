<?php namespace Streams\Platform\Entry;

use Streams\Platform\Model\Presenter\EloquentPresenter;

class EntryPresenter extends EloquentPresenter
{
    public function __get($key)
    {
        if ($assignment = $this->resource->findAssignmentByFieldSlug($key)) {
            if ($assignment) {
                $type = $assignment->field->type
                    ->setAssignment($assignment)
                    ->setEntry($this->resource)
                    ->setValue($this->resource->{$assignment->field->slug});

                return app('streams.decorator')->decorate($type);
            }
        }

        return parent::__get($key);
    }
}
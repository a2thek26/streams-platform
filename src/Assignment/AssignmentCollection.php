<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\FieldType\Contract\DateFieldTypeInterface;
use Anomaly\Streams\Platform\Addon\FieldType\Contract\RelationFieldTypeInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Class AssignmentCollection
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Assignment
 */
class AssignmentCollection extends EloquentCollection
{

    /**
     * Find an assignment by it's field slug.
     *
     * @param  $slug
     * @return FieldInterface
     */
    public function findByFieldSlug($slug)
    {
        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $item->getFieldSlug() == $slug) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return only assignments that have relation fields.
     *
     * @return AssignmentCollection
     */
    public function relations()
    {
        $relations = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $type = $item->getFieldType()) {
                if ($type instanceof RelationFieldTypeInterface) {
                    $relations[] = $item;
                }
            }
        }

        return self::make($relations);
    }

    /**
     * Return only assignments that have date fields.
     *
     * @return AssignmentCollection
     */
    public function dates()
    {
        $dates = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $type = $item->getFieldType()) {
                if ($type instanceof DateFieldTypeInterface) {
                    $dates[] = $item;
                }
            }
        }

        return self::make($dates);
    }

    /**
     * Return an array of field slugs.
     *
     * @return array
     */
    public function fieldSlugs()
    {
        $slugs = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $slug = $item->getFieldSlug()) {
                $slugs[] = $slug;
            }
        }

        return $slugs;
    }

    /**
     * Return only assignments with locked fields.
     *
     * @return AssignmentCollection
     */
    public function locked()
    {
        $items = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $field = $item->getField()) {
                if ($field->isLocked()) {
                    $items[] = $item;
                }
            }
        }

        return new static($items);
    }

    /**
     * Return only assignments with fields
     * that are not locked.
     *
     * @return AssignmentCollection
     */
    public function notLocked()
    {
        $items = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $field = $item->getField()) {
                if (!$field->isLocked()) {
                    $items[] = $item;
                }
            }
        }

        return new static($items);
    }
}

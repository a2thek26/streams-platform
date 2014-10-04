<?php namespace Streams\Platform\Entry;

use Streams\Platform\Model\EloquentModel;
use Streams\Platform\Stream\StreamModel;
use Streams\Platform\Entry\EntryObserver;
use Streams\Platform\Entry\EntryPresenter;
use Streams\Platform\Entry\EntryCollection;

class EntryModel extends EloquentModel
{
    /**
     * Stream data
     *
     * @var array/null
     */
    protected $stream = [];

    /**
     * Create a new EntryModel instance.
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->stream = (new StreamModel())->object($this->stream);

        $this->stream->parent = $this;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(new EntryObserver());
    }

    /**
     * Return the default columns.
     *
     * @return array
     */
    public function defaultColumns()
    {
        return [$this->getKeyName(), $this->CREATED_AT, 'createdByUser'];
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function setAttribute($key, $value)
    {
        // First we will check for the presence of a mutator for the set operation
        // which simply lets the developers tweak the attribute as it is set on
        // the model, such as "json_encoding" an listing of data for storage.
        if ($key and $this->hasSetMutator($key)) {
            $method = 'set' . studly_case($key) . 'Attribute';

            $value = $this->{$method}($value);
        }

        // If an attribute is listed as a "date", we'll convert it from a DateTime
        // instance into a form proper for storage on the database tables using
        // the connection grammar's date format. We will auto set the values.
        elseif (in_array($key, $this->getDates()) && $value) {
            $value = $this->fromDateTime($value);
        }

        // Lastly if we have a type for this key - use the field type
        // mutate method to transform the value to storage format.
        elseif ($assignment = $this->findAssignmentByFieldSlug($key)) {
            if ($type = $assignment->fieldType()) {
                $value = $type->mutate($value);
            }
        }

        $this->attributes[$key] = $value;
    }

    /**
     * Set entry information that every record needs.
     *
     * @return $this
     */
    public function setMetaAttributes()
    {
        if (!$this->exists) {
            $createdBy = \Sentry::getUser()->id or null;

            $this->setAttribute('created_by', $createdBy);
            $this->setAttribute('updated_at', null);
            $this->setAttribute('ordering_count', $this->count('id') + 1);
        } else {
            $updatedBy = \Sentry::getUser()->id or null;

            $this->setAttribute('updated_by', $updatedBy);
            $this->setAttribute('updated_at', time());
        }

        return $this;
    }

    /**
     * Find an assignment by it's slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findAssignmentByFieldSlug($slug)
    {
        return $this
            ->stream
            ->assignments
            ->findByFieldSlug($slug);
    }

    /**
     * Return a bootstrapped field type object.
     *
     * @param $slug
     * @return mixed
     */
    public function fieldType($slug)
    {
        return $this->findAssignmentByFieldSlug($slug)->fieldType();
    }

    /**
     * Get the stream data.
     *
     * @return array
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Return the table name with the stream prefix.
     *
     * @return string
     */
    public function getTable()
    {
        $stream = $this->getStream();

        return $stream->prefix . $stream->slug;
    }

    /**
     * Return a new collection instance.
     *
     * @param array $items
     * @return \Illuminate\Database\Eloquent\Collection|EntryCollection
     */
    public function newCollection(array $items = [])
    {
        return new EntryCollection($items);
    }

    /**
     * Return a new presenter instance.
     *
     * @param $resource
     * @return EntryPresenter|\Streams\Platform\Model\Presenter\EloquentPresenter
     */
    public function newPresenter($resource)
    {
        return new EntryPresenter($resource);
    }
}
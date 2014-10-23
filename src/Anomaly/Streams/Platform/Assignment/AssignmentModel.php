<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\FieldType\Command\BuildFieldTypeCommand;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Assignment\Event\FieldWasAssignedEvent;
use Anomaly\Streams\Platform\Assignment\Event\FieldWasUnassignedEvent;

class AssignmentModel extends EloquentModel
{
    /**
     * Do not use timestamp columns.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define the table name
     *
     * @var string
     */
    protected $table = 'streams_assignments';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(new AssignmentObserver());
    }

    /**
     * Add an assignment.
     *
     * @param $sortOrder
     * @param $streamId
     * @param $fieldId
     * @param $name
     * @param $instructions
     * @param $settings
     * @param $rules
     * @param $isTranslatable
     * @param $isRevisionable
     * @return $this
     */
    public function add(
        $sortOrder,
        $streamId,
        $fieldId,
        $name,
        $instructions,
        $settings,
        $rules,
        $isTranslatable,
        $isRevisionable
    ) {
        $this->name            = $name;
        $this->rules           = $rules;
        $this->field_id        = $fieldId;
        $this->settings        = $settings;
        $this->stream_id       = $streamId;
        $this->sort_order      = $sortOrder;
        $this->instructions    = $instructions;
        $this->is_translatable = $isTranslatable;
        $this->is_revisionable = $isRevisionable;

        $this->save();

        $this->raise(new FieldWasAssignedEvent($this));

        return $this;
    }

    /**
     * Remove an assignment.
     *
     * @param $streamId
     * @param $fieldId
     * @return $this|bool
     */
    public function remove($streamId, $fieldId)
    {
        $assignment = $this->whereStreamId($streamId)->whereFieldId($fieldId)->first();

        if ($assignment) {
            $assignment->delete();

            $this->raise(new FieldWasUnassignedEvent($assignment));

            return $this;
        }

        return false;
    }

    /**
     * Find orphaned assignments.
     *
     * @return mixed
     */
    public function findAllOrphaned()
    {
        return $this->select('streams_assignments.*')
            ->leftJoin('streams_streams', 'streams_assignments.stream_id', '=', 'streams_streams.id')
            ->leftJoin('streams_fields', 'streams_assignments.field_id', '=', 'streams_fields.id')
            ->whereNull('streams_streams.id')
            ->orWhereNull('streams_fields.id')
            ->get();
    }

    public function stream()
    {
        return $this->belongsTo('Anomaly\Streams\Platform\Stream\StreamModel', 'stream_id');
    }

    public function field()
    {
        return $this->belongsTo('Anomaly\Streams\Platform\Field\FieldModel');
    }

    public function getSettingsAttribute($settings)
    {
        return json_decode($settings);
    }

    public function setSettingsAttribute($settings)
    {
        $this->attributes['settings'] = json_encode($settings);
    }

    public function getRulesAttribute($rules)
    {
        return json_decode($rules);
    }

    public function setRulesAttribute($rules)
    {
        $this->attributes['rules'] = json_encode($rules);
    }

    public function newCollection(array $items = [])
    {
        return new AssignmentCollection($items);
    }

    public function newPresenter()
    {
        return new AssignmentPresenter($this);
    }
}
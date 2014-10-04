<?php namespace Streams\Platform\Field\Command;

use Laracasts\Commander\Events\DispatchableTrait;
use Streams\Platform\Field\FieldModel;
use Streams\Platform\Stream\StreamModel;
use Streams\Platform\Contract\CommandInterface;
use Streams\Platform\Assignment\AssignmentModel;

class UnassignFieldCommandHandler implements CommandInterface
{
    use DispatchableTrait;

    /**
     * The stream model.
     *
     * @var \Streams\Platform\Stream\StreamModel
     */
    protected $stream;

    /**
     * The field model.
     *
     * @var \Streams\Platform\Field\Model\FieldModel
     */
    protected $field;

    /**
     * The assignment model.
     *
     * @var \Streams\Platform\Assignment\AssignmentModel
     */
    protected $assignment;

    /**
     * Create a new UnassignFieldCommandHandler instance.
     *
     * @param StreamModel     $stream
     * @param FieldModel      $field
     * @param AssignmentModel $assignment
     */
    function __construct(
        StreamModel $stream,
        FieldModel $field,
        AssignmentModel $assignment
    ) {
        $this->field      = $field;
        $this->stream     = $stream;
        $this->assignment = $assignment;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return $this|mixed
     */
    public function handle($command)
    {
        $stream = $this->stream->findByNamespaceAndSlug($command->getNamespace(), $command->getStream());
        $field  = $this->field->findByNamespaceAndSlug($command->getNamespace(), $command->getField());

        $assignment = $this->assignment->remove($stream->getKey(), $field->getKey());

        $this->dispatchEventsFor($assignment);

        return $assignment;
    }
}
 
<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\FilterCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Row\RowCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\View\ViewCollection;
use Anomaly\Streams\Platform\Ui\Table\Contract\TableModelInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Table
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui\Table
 */
class Table
{

    /**
     * The table model.
     *
     * @var null|TableModelInterface
     */
    protected $model = null;

    /**
     * The table stream.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The table content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The table response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * The table data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The table rows.
     *
     * @var RowCollection
     */
    protected $rows;

    /**
     * The table views.
     *
     * @var Component\View\ViewCollection
     */
    protected $views;

    /**
     * The table entries.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $entries;

    /**
     * The table filters.
     *
     * @var Component\Filter\FilterCollection
     */
    protected $filters;

    /**
     * The table options.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $options;

    /**
     * The table actions.
     *
     * @var Component\Action\ActionCollection
     */
    protected $actions;

    /**
     * The table headers.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $headers;

    /**
     * Create a new Table instance.
     *
     * @param Collection       $data
     * @param Collection       $options
     * @param Collection       $entries
     * @param Collection       $headers
     * @param RowCollection    $rows
     * @param ViewCollection   $views
     * @param ActionCollection $actions
     * @param FilterCollection $filters
     */
    public function __construct(
        Collection $data,
        Collection $options,
        Collection $entries,
        Collection $headers,
        RowCollection $rows,
        ViewCollection $views,
        ActionCollection $actions,
        FilterCollection $filters
    ) {
        $this->data    = $data;
        $this->rows    = $rows;
        $this->views   = $views;
        $this->actions = $actions;
        $this->entries = $entries;
        $this->headers = $headers;
        $this->filters = $filters;
        $this->options = $options;
    }

    /**
     * Set the table response.
     *
     * @param null|Response $response
     * @return $this
     */
    public function setResponse(Response $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the table response.
     *
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the model object.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model object.
     *
     * @return null|TableModelInterface
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the table stream.
     *
     * @param StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the table stream.
     *
     * @return null|StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the table content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the table content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the actions.
     *
     * @param ActionCollection $actions
     * @return $this
     */
    public function setActions(ActionCollection $actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get the actions.
     *
     * @return ActionCollection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set the table filters.
     *
     * @param FilterCollection $filters
     * @return $this
     */
    public function setFilters(FilterCollection $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get the table filters.
     *
     * @return FilterCollection
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set the table options.
     *
     * @param Collection $options
     * @return $this
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the table options.
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the table entries.
     *
     * @param Collection $entries
     * @return $this
     */
    public function setEntries(Collection $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * Get the table entries.
     *
     * @return Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set the table headers.
     *
     * @param Collection $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the table headers.
     *
     * @return Collection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the table views.
     *
     * @param ViewCollection $views
     * @return $this
     */
    public function setViews(ViewCollection $views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get the table views.
     *
     * @return ViewCollection
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the table data.
     *
     * @param Collection $data
     * @return $this
     */
    public function setData(Collection $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the table data.
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the table rows.
     *
     * @param RowCollection $rows
     * @return $this
     */
    public function setRows(RowCollection $rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Get the table rows.
     *
     * @return RowCollection
     */
    public function getRows()
    {
        return $this->rows;
    }
}

<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;

/**
 * Class Filter
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui\Table\Component\Filter
 */
class Filter implements FilterInterface
{

    /**
     * The filter slug.
     *
     * @var string
     */
    protected $slug = 'default';

    /**
     * The filter prefix.
     *
     * @var null|string
     */
    protected $prefix = null;

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The filter placeholder.
     *
     * @var null|string
     */
    protected $placeholder = null;

    /**
     * The filter handler.
     *
     * @var mixed
     */
    protected $handler = 'Anomaly\Streams\Platform\Ui\Table\Component\Filter\FilterHandler@handle';

    /**
     * Set the filter handler.
     *
     * @param $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get the filter handler.
     *
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Get the filter input.
     *
     * @return null|string
     */
    public function getInput()
    {
        return null;
    }

    /**
     * Get the filter name.
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->getPrefix() . 'filter_' . $this->getSlug();
    }

    /**
     * Get the filter value.
     *
     * @return null|string
     */
    public function getValue()
    {
        return app('request')->get($this->getFieldName());
    }

    /**
     * Set the active flag.
     *
     * @param bool $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the filter placeholder.
     *
     * @param string $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get the filter placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set the filter prefix.
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the filter prefix.
     *
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set the filter slug.
     *
     * @param $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the filter slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}

<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract;

/**
 * Interface ColumnInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract
 */
interface ColumnInterface
{

    /**
     * Set the column class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class);

    /**
     * Get the column class.
     *
     * @return null|string
     */
    public function getClass();

    /**
     * Set the column header.
     *
     * @param $header
     * @return $this
     */
    public function setHeader($header);

    /**
     * Get the column header.
     *
     * @return null|string
     */
    public function getHeader();

    /**
     * Set the column value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get the column value.
     *
     * @return mixed|null
     */
    public function getValue();
}

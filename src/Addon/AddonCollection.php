<?php namespace Anomaly\Streams\Platform\Addon;

use Illuminate\Support\Collection;

/**
 * Class AddonCollection
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Addon
 */
class AddonCollection extends Collection
{

    /**
     * Return only core addons.
     *
     * @return AddonCollection
     */
    public function core()
    {
        $core = [];

        foreach ($this->items as $item) {
            if ($item->isCore()) {
                $core[] = $item;
            }
        }

        return self::make($core);
    }

    /**
     * Push an addon to the collection.
     *
     * @param mixed $addon
     */
    public function push($addon)
    {
        if ($addon instanceof Addon) {
            $this->items[$addon->getSlug()] = $addon;
        }
    }

    /**
     * Find an addon by it's slug.
     *
     * @param  $slug
     * @return null|Addon
     */
    public function findBySlug($slug)
    {
        foreach ($this->items as $item) {
            if ($item instanceof Addon && $item->getSlug() == $slug) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Order addon's by their slug.
     *
     * @param  string $direction
     * @return AddonCollection
     */
    public function orderBySlug($direction = 'asc')
    {
        $ordered = [];

        foreach ($this->items as $item) {
            if ($item instanceof Addon) {
                $ordered[$item->getSlug()] = $item;
            }
        }

        if ($direction == 'asc') {
            ksort($ordered);
        } else {
            krsort($ordered);
        }

        return self::make($ordered);
    }
}

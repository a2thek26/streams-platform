<?php namespace Anomaly\Streams\Platform\Addon;

use Composer\Autoload\ClassLoader;

/**
 * Class AddonLoader
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Addon
 */
class AddonLoader extends ClassLoader
{

    /**
     * Load the addon.
     *
     * @param $type
     * @param $slug
     * @param $path
     */
    public function load($path)
    {
        $composer = json_decode(file_get_contents($path . '/composer.json'), true);

        if (!array_key_exists('autoload', $composer)) {
            return;
        }

        foreach (array_get($composer['autoload'], 'psr-4', []) as $namespace => $autoload) {
            parent::addPsr4($namespace, $path . '/' . $autoload, false);
        }

        foreach (array_get($composer['autoload'], 'psr-0', []) as $namespace => $autoload) {
            parent::add($namespace, $path . '/' . $autoload, false);
        }

        parent::register();
    }
}

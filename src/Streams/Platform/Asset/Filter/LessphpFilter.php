<?php namespace Streams\Platform\Asset\Filter;

use Assetic\Asset\AssetInterface;

class LessphpFilter extends \Assetic\Filter\LessphpFilter
{
    /**
     * Override the filter dump method.
     *
     * @param AssetInterface $asset
     */
    public function filterDump(AssetInterface $asset)
    {
        $asset->setContent(\View::parse($asset->getContent()));

        return parent::filterDump($asset);
    }
}
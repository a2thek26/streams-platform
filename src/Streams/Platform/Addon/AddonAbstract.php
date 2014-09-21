<?php namespace Streams\Platform\Addon;

use Streams\Platform\Traits\CallableTrait;
use Streams\Platform\Contract\PresenterInterface;

abstract class AddonAbstract implements PresenterInterface
{
    use CallableTrait;

    /**
     * The addon type.
     *
     * @var string
     */
    protected $type = null;

    /**
     * The slug of the addon.
     *
     * @var string
     */
    protected $slug = null;

    /**
     * The path to the addon.
     *
     * @var
     */
    protected $path = null;

    /**
     * Is this addon installed?
     *
     * @var null
     */
    protected $installed = null;

    /**
     * Is this addon enabled?
     *
     * @var null
     */
    protected $enabled = null;

    /**
     * Set the installed property.
     *
     * @return bool
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;

        return $this;
    }

    /**
     * Set the enabled property.
     *
     * @return bool
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Is this addon installed?
     *
     * @return bool
     */
    public function isInstalled()
    {
        return $this->installed;
    }

    /**
     * Is this addon enabled?
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled and $this->installed;
    }

    /**
     * Is this a core addon?
     *
     * @var bool
     */
    public function isCore()
    {
        return (strpos($this->path, base_path('app/')) !== false);
    }

    /**
     * Set the path of the addon.
     *
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the pth of the addon.
     *
     * @return string
     */
    public function getPath($path = null)
    {
        return $this->path . ($path ? '/' . $path : null);
    }

    /**
     * Set the slug of the addon.
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
     * Get the slug of the addon.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the addon type.
     *
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the addon type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return a new presenter instance.
     *
     * @param $resource
     * @return null
     */
    public function newPresenter($resource)
    {
        return null;
    }

    /**
     * Return a new addon model instance.
     *
     * @return null
     */
    public function newModel()
    {
        return null;
    }

    /**
     * Return a new addon installer instance.
     *
     * @return mixed
     */
    public function newInstaller()
    {
        $slug      = studly_case($this->slug);
        $addon     = str_singular(studly_case($this->type));
        $installer = studly_case($slug . '_' . $this->getType() . 'installer');

        $installer = 'Streams\Addon\\' . $addon . '\\' . $slug . '\\Installer\\' . $installer;

        return new $installer($this);
    }

    /**
     * Object to string method.
     * This is required of the presenter.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this);
    }
}
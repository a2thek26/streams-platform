<?php namespace Streams\Platform\Collection;

use Illuminate\Support\Collection;

class CacheCollection extends Collection
{
    /**
     * Our cache collection key.
     *
     * @var string|string
     */
    protected $key;

    /**
     * Create a new CacheCollection instance.
     *
     * @param array  $items
     * @param string $key
     */
    public function __construct(array $items, $key = null)
    {
        $this->key   = $key;
        $this->items = $items;
    }

    /**
     * Add cache keys.
     *
     * @param array $keys
     * @return $this
     */
    public function addKeys(array $keys = [])
    {
        foreach ($keys as $key) {
            $this->push($key);
        }

        $this->unique();

        return $this;
    }

    /**
     * Index cache keys.
     *
     * @return $this
     */
    public function index()
    {
        if ($keys = \Cache::get($this->key)) {
            $this->addKeys($keys);
        }

        $this->unique();

        \Cache::forget($this->key);

        $self = $this;

        \Cache::rememberForever(
            $this->key,
            function () use ($self) {
                return $self->all();
            }
        );

        return $this;
    }

    /**
     * Flush cache keys.
     *
     * @return $this
     */
    public function flush()
    {
        foreach ($this->items as $key) {
            \Cache::forget($key);
        }

        \Cache::forget($this->key);

        $this->items = [];

        return $this;
    }

    /**
     * Set the collection key.
     *
     * @param null $key
     * @return $this
     */
    public function setKey($key = null)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Filter cached items as unique only.
     *
     * @return $this|Collection
     */
    public function unique()
    {
        $this->items = array_unique($this->items);

        $this->values();

        return $this;
    }
}
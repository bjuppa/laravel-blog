<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Illuminate\Support\Collection;

class BlogRegistry implements BlogRegistryContract
{
    /**
     * The registered Blog instances
     * @var Collection
     */
    protected $blogs;

    /**
     * BlogRegistry constructor.
     */
    public function __construct()
    {
        $this->blogs = new Collection();
    }

    /**
     * Add multiple blogs and configure them
     *
     * @param iterable $configurations
     * @return $this
     */
    public function configureMultipleBlogs(iterable $configurations): BlogRegistryContract
    {
        foreach ($configurations as $id => $configuration) {
            $this->configureSingleBlog($id, $configurations);
        }

        return $this;
    }

    /**
     * Add a single blog and configure it
     *
     * @param string $id
     * @param iterable $configuration
     * @return $this
     */
    public function configureSingleBlog(string $id, iterable $configuration): BlogRegistryContract
    {
        // TODO: create new Blog
        // TODO: set configuration values on the new Blog

        return $this;
    }
}

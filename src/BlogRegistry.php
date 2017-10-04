<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;

class BlogRegistry implements BlogRegistryContract
{
    /**
     * The registered Blog instances
     * @var Collection
     */
    protected $blogs;

    /**
     * The service container for resolving class instances
     * @var Container
     */
    protected $app;

    /**
     * BlogRegistry constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
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
            $this->configureBlog($id, $configuration);
        }

        return $this;
    }

    /**
     * Add a single blog and configure it
     *
     * @param string $blog_id
     * @param iterable $configuration
     * @return $this
     */
    public function configureBlog(string $blog_id, iterable $configuration): BlogRegistryContract
    {
        $this->getOrNew($blog_id)->configure($configuration);

        return $this;
    }

    /**
     * Add a new blog if not existing
     *
     * @param string $blog_id
     * @return Blog
     */
    protected function getOrNew(string $blog_id): Blog
    {
        if (!$this->has($blog_id)) {
            $this->blogs->put($blog_id, $this->app->make(Blog::class, ['blog_id' => $blog_id]));
        }

        return $this->get($blog_id);
    }

    /**
     * Get a blog from this repository
     *
     * @param string $blog_id
     * @return Blog|null
     */
    public function get(string $blog_id): ?Blog
    {
        return $this->blogs->get($blog_id);
    }

    /**
     * Check if a blog exists in this repository
     *
     * @param string $blog_id
     * @return bool
     */
    public function has(string $blog_id): bool
    {
        return $this->blogs->has($blog_id);
    }
}

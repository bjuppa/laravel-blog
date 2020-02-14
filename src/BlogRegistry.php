<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
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

    /**
     * Get the registered blogs
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->blogs;
    }

    /**
     * Get the best matching Blog for a Request instance
     *
     * @param Request $request
     * @return Blog|null
     */
    public function getBlogMatchingRequest(Request $request): ?Blog
    {
        return $this->blogs->first(function (Blog $blog) use ($request) {
            return $request->routeIs($blog->prefixRouteName() . '*');
        });
    }

    /**
     * Register a blog
     * @param Blog $blog
     * @return $this
     */
    public function add(Blog $blog): BlogRegistryContract
    {
        $this->blogs->put($blog->getId(), $blog);

        return $this;
    }
}

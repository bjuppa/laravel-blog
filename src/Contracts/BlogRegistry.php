<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BlogRegistry
{
    /**
     * Register a blog
     * @param Blog $blog
     * @return $this
     */
    public function add(Blog $blog): BlogRegistry;

    /**
     * Get a blog from this repository
     *
     * @param string $blog_id
     * @return Blog|null
     */
    public function get(string $blog_id): ?Blog;

    /**
     * Check if a blog exists in this repository
     *
     * @param string $blog_id
     * @return bool
     */
    public function has(string $blog_id): bool;

    /**
     * Get the registered blogs
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get the best matching Blog for a Request instance
     *
     * @param Request $request
     * @return Blog|null
     */
    public function getBlogMatchingRequest(Request $request): ?Blog;
}

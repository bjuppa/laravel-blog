<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Illuminate\Support\Collection;

interface BlogRegistry
{
    /**
     * Add multiple blogs and configure them
     *
     * @param iterable $configurations
     * @return $this
     */
    public function configureMultipleBlogs(iterable $configurations): BlogRegistry;

    /**
     * Add a single blog and configure it
     *
     * @param string $blog_id
     * @param iterable $configuration
     * @return $this
     */
    public function configureBlog(string $blog_id, iterable $configuration): BlogRegistry;

    /**
     * Get the registered blogs
     * @return Collection
     */
    public function all(): Collection;
}

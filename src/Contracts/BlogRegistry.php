<?php

namespace Bjuppa\LaravelBlog\Contracts;


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
     * @param string $id
     * @param iterable $configuration
     * @return $this
     */
    public function configureSingleBlog(string $id, iterable $configuration): BlogRegistry;

}

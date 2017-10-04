<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface Blog
{
    /**
     * Blog constructor.
     *
     * @param BlogEntryProvider $provider
     * @param string $id
     * @param iterable $configuration
     */
    public function __construct(BlogEntryProvider $provider, string $id, iterable $configuration = []);

    /**
     * Set configuration values on the blog
     *
     * @param iterable $configuration
     * @return $this
     */
    public function configure(iterable $configuration): Blog;

    /**
     * Set the path part of the url to the blog
     *
     * @param string $path
     * @return $this
     */
    public function withPublicPath(string $path): Blog;

    /**
     * Get the path part of the url to the blog
     *
     * @return string
     */
    public function getPublicPath(): string;

    /**
     * Get the blog's identifier
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get the blog's entry provider instance
     * @return BlogEntryProvider
     */
    public function getEntryProvider(): BlogEntryProvider;
}

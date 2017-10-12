<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface Blog
{
    /**
     * Blog constructor.
     *
     * @param string $blog_id
     * @param iterable $configuration
     */
    public function __construct(string $blog_id, iterable $configuration = []);

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
     * Prefix a route name for this blog
     *
     * @param string $name If empty, only the prefix is returned
     * @return string
     */
    public function prefixRouteName(string $name = ''): string;

    /**
     * Get the blog's entry provider instance
     * @return BlogEntryProvider
     */
    public function getEntryProvider(): BlogEntryProvider;

    /**
     * Get an entry instance from a slug
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findEntry(string $slug): ?BlogEntry;
}

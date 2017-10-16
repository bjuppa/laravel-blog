<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Illuminate\Support\Collection;

interface Blog
{
    /**
     * Blog constructor.
     *
     * @param string $blog_id
     * @param iterable $configuration
     * @param BlogEntryProvider $provider
     */
    public function __construct(string $blog_id, BlogEntryProvider $provider, iterable $configuration = []);

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
     *
     * @return BlogEntryProvider
     */
    public function getEntryProvider(): BlogEntryProvider;

    /**
     * Get an entry instance from a slug
     *
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findEntry(string $slug): ?BlogEntry;

    /**
     * Get the newest entries of the blog
     *
     * @param int|null $limit Desired number of entries unless you want the blog's default
     * @return Collection
     */
    public function latestEntries(int $limit = null): Collection;

    /**
     * Get the number of default entries to show
     *
     * @return int
     */
    public function getLatestEntriesLimit(): int;

    /**
     * Set the number of default entries to show
     *
     * @param int $limit
     * @return $this
     */
    public function withLatestEntriesLimit(int $limit): Blog;

    /**
     * Set a specific domain for this blog
     *
     * @param string $domain
     * @return $this
     */
    public function withDomain(string $domain): Blog;

    /**
     * Get the domain for this blog
     *
     * @return string|null
     */
    public function getDomain(): ?string;

    /**
     * Set middleware for the blog's routes
     * @param array|string|\Closure $middleware
     * @return $this
     */
    public function withMiddleware($middleware): Blog;

    /**
     * Get middleware to apply to the blog's routes
     * @return array|string|\Closure
     */
    public function getMiddleware();
}

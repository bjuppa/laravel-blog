<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Carbon\Carbon;
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
     * Get the domain for this blog.
     * Return null to accept any domain.
     *
     * @return string|null
     */
    public function getDomain(): ?string;

    /**
     * Get middleware to apply to the blog's routes
     * @return array|string|\Closure
     */
    public function getMiddleware();

    /**
     * Get the full public url to the blog's index page
     * @return string
     */
    public function urlToIndex(): string;

    /**
     * Get the full public url to the blog's atom feed
     * @return string
     */
    public function urlToFeed(): string;

    /**
     * Get the full public url to a single entry within this blog
     * @param BlogEntry $entry
     * @return string
     */
    public function urlToEntry(BlogEntry $entry): string;

    /**
     * Get the title of the blog
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get the html head page title of the blog
     * @return string
     */
    public function getPageTitle(): string;

    /**
     * Get string to append after html page title on entry pages
     * @return string
     */
    public function getEntryPageTitleSuffix(): string;

    /**
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon;

    /**
     * The blog's authors
     * (should not be empty)
     * @return Collection
     */
    public function getAuthors(): Collection;

    /**
     * Get the stylesheets used for this blog
     * @return Collection
     */
    public function getStylesheets(): Collection;

    /**
     * Get the meta-description for this blog
     * @return string|null
     */
    public function getMetaDescription(): ?string;
}

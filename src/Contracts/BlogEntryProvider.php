<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface BlogEntryProvider
{
    /**
     * Set the id of the blog to use
     * @param string $blog_id
     * @return $this
     */
    public function withBlogId(string $blog_id): BlogEntryProvider;

    /**
     * Get a blog entry from a slug
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry;

    /**
     * Get the next entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function nextEntry(BlogEntry $entry): ?BlogEntry;

    /**
     * Get the previous entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function previousEntry(BlogEntry $entry): ?BlogEntry;

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection;

    /**
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon;
}

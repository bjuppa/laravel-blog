<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;

trait QueriesEntryProvider
{
    /**
     * Get an entry instance from a slug
     *
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findEntry(string $slug): ?BlogEntry
    {
        return $this->getEntryProvider()->findBySlug($slug);
    }

    /**
     * Get the newest entries of the blog
     *
     * @param int|null $limit Desired number of entries unless you want the blog's default
     * @return Collection
     */
    public function latestEntries(int $limit = null): Collection
    {
        return $this->getEntryProvider()->latest($limit ?? $this->getLatestEntriesLimit());
    }

    /**
     * Get the next entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function nextEntry(BlogEntry $entry): ?BlogEntry
    {
        return $this->getEntryProvider()->nextEntry($entry);
    }

    /**
     * Get the previous entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function previousEntry(BlogEntry $entry): ?BlogEntry
    {
        return $this->getEntryProvider()->previousEntry($entry);
    }

    /**
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return $this->getEntryProvider()->getUpdated();
    }
}

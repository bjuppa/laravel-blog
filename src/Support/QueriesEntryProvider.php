<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Illuminate\Support\Collection;
use Carbon\Carbon;

trait QueriesEntryProvider {
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
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return $this->getEntryProvider()->getUpdated();
    }
}

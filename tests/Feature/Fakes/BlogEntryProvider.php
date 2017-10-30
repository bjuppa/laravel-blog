<?php

namespace Bjuppa\LaravelBlog\Tests\Feature\Fakes;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BlogEntryProvider implements BlogEntryProviderContract
{
    /**
     * Get a blog entry from a slug
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry
    {
        return null;
    }

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection
    {
        return new Collection();
    }

    /**
     * Set the id of the blog to use
     * @param string $blog_id
     * @return BlogEntryProviderContract
     */
    public function withBlogId(string $blog_id): BlogEntryProviderContract
    {
        return $this;
    }

    /**
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return now();
    }

    /**
     * If the entry provider has Laravel database migrations for its models, return the path to migrations.
     * @return string|null
     */
    public function getDatabaseMigrationsPath(): ?string
    {
        return null;
    }
}

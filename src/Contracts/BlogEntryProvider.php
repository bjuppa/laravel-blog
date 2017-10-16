<?php

namespace Bjuppa\LaravelBlog\Contracts;

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
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry;

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection;
}

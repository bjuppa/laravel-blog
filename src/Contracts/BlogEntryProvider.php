<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Illuminate\Support\Collection;

interface BlogEntryProvider
{
    /**
     * BlogEntryProvider constructor.
     * @param string $blog_id
     */
    public function __construct(string $blog_id);

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
